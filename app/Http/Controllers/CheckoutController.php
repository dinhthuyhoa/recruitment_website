<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Enums\UserRole;
use App\Models\PackagePayment;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessful;
use Faker\Generator;


class CheckoutController extends Controller
{
    public function admin_payment_management_list() {
        if (Auth::user()->role == UserRole::Administrator) {
            $payment_list = Checkout::all();
        }

        foreach ($payment_list as $v) {
            $v->user = User::find($v->user_id);
        }

        return view('admin.pages.payment-management', compact('payment_list'));
    }

    public function admin_payment_management_create () {
        $packages = PackagePayment::where('package_status', '=', 'active')->get();
        // dd($package);
        $users = User::where('role', '=', 'recruiter')->get();
        return view('admin.pages.payment-create', compact('packages', 'users'));
    }

    public function admin_payment_management_store (Request $request) {
        // dd($request);
        $package = PackagePayment::find($request->package_payment_id);
        // dd($package);
        $dateTime = Carbon::now();
        $checkoutExpiredTime = $dateTime->addMonths($package->package_date);
        // dd($checkoutExpiredTime);
        $checkout_new = Checkout::create([
            'user_id' => $request->user_id,
            'package_payment_id'=> $request->package_payment_id,
            'checkout_type' => $package->title_package,
            'post_content' => $package->package_content,
            'checkout_date' => $dateTime,
            'checkout_expired_time' => $checkoutExpiredTime,
            'value_checkout' => $package->value_package,
            'checkout_status' => "Paid",
        ]);
        if ($request->submit == 'redirect') {

            session()->put('successMessage', 'Tạo thành công đơn thanh toán mới!');

            if (session()->has('successMessage')) {
                $successMessage = session('successMessage');
                $packages = PackagePayment::where('package_status', '=', 'active')->get();

                $users = User::where('role', '=', 'recruiter')->get();
                $checkout = Checkout::find($checkout_new->id);
                return view('admin.pages.payment-edit', compact('users', 'packages' ,'checkout', 'successMessage'));
            }

        } else {
            return back()->with('successMessage', 'Tạo thành công bài gói thanh toán mới!');
        }

    }

    public function admin_payment_management_edit ($id) {
        $packages = PackagePayment::where('package_status', '=', 'active')->get();
        $users = User::where('role', '=', 'recruiter')->get();
        $checkout = Checkout::find($id);
        // $payment = $checkout;
        return view('admin.pages.payment-edit', compact('users', 'packages' ,'checkout'));
    }

    public function admin_payment_management_update (Request $request, $id) {
        // dd($request);
        $package = PackagePayment::find($request->package_payment_id);
        // dd($package);
        $dateTime = Carbon::now();
        $checkoutExpiredTime = $dateTime->addMonths($package->package_date);
        // dd($checkoutExpiredTime);
        $checkout_new = Checkout::find($id);
        // dd($checkout_new);
        $checkout_new->update([
            'user_id' => $request->user_id,
            'package_payment_id'=> $request->package_payment_id,
            'checkout_type' => $package->title_package,
            'post_content' => $package->package_content,
            'checkout_date' => $dateTime,
            'checkout_expired_time' => $checkoutExpiredTime,
            'value_checkout' => $package->value_package,
            'checkout_status' => "Paid",
        ]);
        if ($request->submit == 'redirect') {

            session()->put('successMessage', 'Update thành công đơn thanh toán mới!');

            if (session()->has('successMessage')) {
                $successMessage = session('successMessage');
                $packages = PackagePayment::where('package_status', '=', 'active')->get();

                $users = User::where('role', '=', 'recruiter')->get();
                $checkout = Checkout::find($checkout_new->id);
                return view('admin.pages.payment-edit', compact('users', 'packages' ,'checkout', 'successMessage'));
            }

        } else {
            return back()->with('successMessage', 'Tạo thành công bài gói thanh toán mới!');
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function package_checkout_frontend(){
        // $packages = [
        //     ['name' => '3 - Month Package', 'price' => 1500000, 'timeout' => 3],
        //     ['name' => '6 - Month Package', 'price' => 2500000, 'timeout' => 6],
        //     ['name' => '1 - Year Package', 'price' => 4500000, 'timeout' => 12],
        // ];
        $packages = PackagePayment::where('package_status', '=', 'active')->get();
        // dd($packages);
        return view('frontend.auth.checkout', compact('packages'));
    }

    public function momo_payment(Request $request) {
        
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $selectedPackageJson = $request->input('selected_package');
        $selectedPackage = json_decode($selectedPackageJson, true);
        // dd($selectedPackage);
        $package_name = $selectedPackage['title_package'];
        $package_timeout = $selectedPackage['package_date'];
        // $amount = $selectedPackage['price'];

        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        
        $package_id = $selectedPackage['id'];
        $orderInfo = $package_name .' - '. $package_timeout . ' mo' . ' - '. $package_id;
        // dd($orderInfo);
        $amount = (string) $selectedPackage['value_package'];
        // dd($amount);
        $orderId = time() ."";
        $returnUrl = route('momo.callback');
        $notifyurl = "http://127.0.0.1:8000/";
        $bankCode = "SML";
        
        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHashArr =  array(
                    'partnerCode' => $partnerCode,
                    'accessKey' => $accessKey,
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'bankCode' => $bankCode,
                    'returnUrl' => $returnUrl,
                    'notifyUrl' => $notifyurl,
                    'extraData' => $extraData,
                    'requestType' => $requestType
                    );
        // echo $serectkey;die;
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array('partnerCode' => $partnerCode,
                    'accessKey' => $accessKey,
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'returnUrl' => $returnUrl,
                    'bankCode' => $bankCode,
                    'notifyUrl' => $notifyurl,
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json
// dd($jsonResult);
        error_log( print_r( $jsonResult, true ) );
        redirect()->to($jsonResult['payUrl']);
        if (isset($_POST['redirect']) && $jsonResult['message'] == 'Success'){
            header('Location: ' . $jsonResult['payUrl']);
            die();
        } else {
                    // dd($jsonResult);
            echo json_encode($jsonResult);
        }

        
        // header('Location: '.$jsonResult['payUrl']);
        
    }
    public function momo_payment_callback(Request $request)
{
    $returnUrl = $request->all();
    // dd($returnUrl);
    // $jsonResult = json_decode($request->getContent(), true);
    // Check if the payment was successful
    if ($returnUrl['errorCode'] == 0) {
        // Extract necessary information from Momo response
        $dateTime = Carbon::now();
        $formattedTime = $dateTime->format('Y-m-d H:i:s');

        // Assuming Momo provides orderInfo in a format like 'Payment for {package_name}-{package_timeout} mo'
        $timeoutInfo = $this->extractTimeoutInfo($returnUrl['orderInfo']);
        // dd($timeoutInfo['package_name']);
        $valueCheckout = $returnUrl['amount'];
        // $user = User::find(session('user_id'));
        // dd($valueCheckout);
        if ($timeoutInfo) {
            $timeout = $timeoutInfo['timeout'];
            $checkoutExpiredTime = $dateTime->addMonths($timeout);
            $user = User::find(session('user_id'));
            // dd($user);
            $checkout = Checkout::create([
                'user_id' => $user['id'],
                'checkout_type' => $timeoutInfo['package_name'],
                'checkout_date' => $formattedTime,
                'checkout_expired_time' => $checkoutExpiredTime,
                'value_checkout' => $valueCheckout,
                'checkout_status' => 'Paid',
            ]);

            if ($user) {
                $user->update([
                    'status' => 'Active',
                    'avatar' => 'https://mir-s3-cdn-cf.behance.net/user/276/d87edf482640497.5e306b1f7af1c.jpg',
                ]);
                Auth::login($user);

                Mail::to($user['email'])->send(new \App\Mail\RegistrationSuccessful($checkout));
            }

            $successMessage = 'Registration Successful';
            // return view('frontend.pages.home', compact('successMessage'));
            return redirect()->route('profile.user', $user['id']);
        } else {
            return response()->json(['error' => 'Timeout information not found.']);
        }
    } else {
        return response()->json(['error' => 'Payment failed.']);
    }
}
public function extractTimeoutInfo($orderInfo)
{
    // Define a regular expression pattern to match "{package_name} - {package_timeout} mo - {package_id}"
    $pattern = '/(.+) - (\d+) mo - (\d+)/';

    // Use preg_match to extract matches
    if (preg_match($pattern, $orderInfo, $matches)) {
        // Assuming the first captured group in the regex is the package_name
        $packageName = $matches[1];
        $timeout = $matches[2];
        $packageId = $matches[3];

        // You can return an associative array with package_name, timeout, and package_id
        return ['package_name' => $packageName, 'timeout' => $timeout, 'package_id' => $packageId];
    }

    return null;
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
            // if (isset($_POST['redirect'])) {
            //     header('Location: ' . $vnp_Url);
            //     die();
            // } else {
            //     echo json_encode($returnData);
            // }
            // dd($returnData['message']);
        if (isset($_POST['redirect']) && $returnData['message'] == 'success'){
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }    
    public function vnpay_payment_callback(Request $request)
{
    $faker = app(Generator::class);

    $data = $request->all();
    $dateTime = Carbon::createFromFormat('YmdHis', $data['vnp_PayDate']);
    $formattedTime = $dateTime->format('Y-m-d H:i:s');

    $timeoutInfo = $this->extractTimeoutInfo($data['vnp_OrderInfo']);

    $valueCheckout = $data['vnp_Amount'] / 100;
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
            'checkout_status' => 'Paid',
        ]);

        if ($user) {
            $user->update([
                'status' => 'Active',
                'avatar' => 'https://mir-s3-cdn-cf.behance.net/user/276/d87edf482640497.5e306b1f7af1c.jpg',
            ]);
            Auth::login($user);

            Mail::to($user['email'])->send(new RegistrationSuccessful($checkout));
        }

        // Pass the success message to the view
        $successMessage = 'Registration Successful';
        return view('frontend.pages.home', compact('successMessage'));
    } else {
        return response()->json(['error' => 'Timeout information not found.']);
    }
}

    // private function extractTimeoutInfo($orderInfo)
    // {
    //     $pattern = '/(\d+) mo/';
    //     preg_match($pattern, $orderInfo, $matches);
    
    //     if (isset($matches[1])) {
    //         return ['timeout' => (int)$matches[1]];
    //     }
    
    //     return null;
    // }

}
