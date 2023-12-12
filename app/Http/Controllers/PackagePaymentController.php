<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\PackagePayment;
class PackagePaymentController extends Controller
{
    //
    public function admin_payment_package_list()
    {
        if (Auth::user()->role == UserRole::Administrator) {
            $package_list = PackagePayment::all();
        }

        foreach ($package_list as $v) {
            $v->user = User::find($v->user_id);
        }

        return view('admin.pages.package-payment', compact('package_list'));
    }

    public function admin_payment_package_create()
    {
        return view('admin.pages.package-payment-create');
    }

    public function admin_payment_package_store (Request $request) {

        $package_new = PackagePayment::create([
            'user_id' => Auth::user()->id,
            'title_package' => $request->title_package,
            'package_date' => $request->package_date,
            'package_status' => "active",
            'package_content' => $request->package_content,
            'value_package' => $request->value_package,
        ]);
        if ($request->submit == 'redirect') {

            session()->put('successMessage', 'Tạo thành công bài gói thanh toán mới!');

            if (session()->has('successMessage')) {
                $successMessage = session('successMessage');
                // dd(1);
                $package = PackagePayment::find($package_new->id);

                return view('admin.pages.package-payment-edit', compact('package', 'successMessage'));
            }

        } else {
            return back()->with('successMessage', 'Tạo thành công bài gói thanh toán mới!');
        }
    }

    public function admin_payment_package_edit($id)
    {
        if (!PackagePayment::whereId($id)->exists()) {
            return redirect('page-not-found');
            // dd(1);
        }
        $package = PackagePayment::find($id);
        // dd($package);
        return view('admin.pages.package-payment-edit', compact('package'));
    }

    public function admin_payment_package_update(Request $request, $id) {

        $package_update = PackagePayment::findOrFail($id);
        $request->validate([
            'title_package' => 'required|string',
            'package_date' => 'required|in:3,6,12', 
            'package_status' => 'required|in:active,inactive', 
            'package_content' => 'required|string',
            'value_package' => 'required|numeric',
        ]);
    // dd($request);
        $package_update->update([
            'title_package' => $request->title_package,
            'package_date' => $request->package_date,
            'package_status' => $request->package_status,
            'package_content' => $request->package_content,
            'value_package' => $request->value_package,
        ]);
    
        
        if (session()->has('successMessage')) {
            // session()->forget('successMessage');
            dd('1');
        }
    
        session()->put('successMessageUpdate', 'Cập nhật thành công gói thanh toán mới!');
        return redirect()->route('admin.payment_package.edit', $id);
    }
    

    public function disable(Request $request, PackagePayment $package)
    {
        // dd($request->input('package_status'));

        $request->validate([
            'accountActivation' => 'required|accepted', 
            'package_status' => 'required|in:inactive', 
        ]);
        // dd($request);
        $package->update(['package_status' => $request->input('package_status')]);
        // dd($user);
        return redirect()->route('admin.payment_package.list')->with('success', 'Package disabled successfully');
    }
}
