<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessful;

class CheckoutController extends Controller
{
    public function package_checkout_frontend(){
        $packages = [
            ['name' => '3 - Month Package', 'price' => 1500000, 'timeout' => 3],
            ['name' => '6 - Month Package', 'price' => 2500000, 'timeout' => 6],
            ['name' => '1 - Year Package', 'price' => 4500000, 'timeout' => 12],
        ];
        return view('frontend.auth.checkout', compact('packages'));
    }
    
    public function vnpay_payment(Request $request) {
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_TmnCode = 'OS7BSTV6';
        $vnp_HashSecret = 'KDWTZTPEXEOFLTKQSJGDNLGGYQWSFHYI';

        $selectedPackageJson = $request->input('selected_package');
        $selectedPackage = json_decode($selectedPackageJson, true);
    
        $package_name = $selectedPackage['name'];
        $package_timeout = $selectedPackage['timeout'];

        $amount = $selectedPackage['price'];
    
        $vnp_OrderInfo = 'Payment for ' . $package_name .'-'. $package_timeout . ' mo';
        $vnp_Amount = $amount*100;
    
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_TxnRef = rand(0, 9999);

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_BankCode" => $vnp_BankCode,
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => route('vnpay.callback'),
            "vnp_TxnRef" => $vnp_TxnRef
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }    
    public function vnpay_payment_callback(Request $request)
    {
        $data = $request->all();
        $dateTime = Carbon::createFromFormat('YmdHis', $data['vnp_PayDate']);
        $formattedTime = $dateTime->format('Y-m-d H:i:s');

        $timeoutInfo = $this->extractTimeoutInfo($data['vnp_OrderInfo']);

        $valueCheckout = $data['vnp_Amount']/100;
        if ($timeoutInfo) {
            $timeout = $timeoutInfo['timeout'];
            $checkoutExpiredTime = $dateTime->addMonths($timeout);
            $user = User::find(session('user_id'));

            $checkout = Checkout::create([
                'user_id' => $user['id'],
                'checkout_type' => $data['vnp_OrderInfo'],
                'checkout_date' => $formattedTime,
                'checkout_expired_time' => $checkoutExpiredTime,
                'value_checkout' => $valueCheckout,
                'checkout_status' => 'Paid'
            ]);
    
            if ($user) {
                $user->update(['status' => 'Active']);
                Mail::to($user['email'])->send(new RegistrationSuccessful($checkout));
            }
    
            return view('frontend.auth.after-checkout');
        } else {
            return response()->json(['error' => 'Timeout information not found.']);
        }
    }
    private function extractTimeoutInfo($orderInfo)
    {
        $pattern = '/(\d+) mo/';
        preg_match($pattern, $orderInfo, $matches);
    
        if (isset($matches[1])) {
            return ['timeout' => (int)$matches[1]];
        }
    
        return null;
    }

}
