<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ArchitectController extends Controller
{


    public function defineCustomer(Request $request,$id = null,$password = null)
    {
        if(!empty($id) and !empty($password)){
            $customer = User::findOrFail($id);
            $request->session()->flash('createUser', 'مشتری با مشخصات زیر ذخیره شد!');
            return view('architect.defineCustomerWithMessage',compact('customer','password'));
        }else{
            return view('architect.defineCustomer');
        }
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:14'],
            'name' => ['required', 'string', 'max:150'],
            'username' => ['max:150'],
            'city' => ['max:150'],
            'building' => ['max:150'],
        ]);
        if (auth()->user()->role == "architect") {
            $id = auth()->user()->id;
            $password = md5(uniqid());
            $username = ($request->username) ? $request->username : $request->mobile;
            $city = ($request->city) ? $request->city : null;
            $building = ($request->building) ? $request->building : null;
            $architect_customers = auth()->user()->customers();
            if (count($architect_customers)>0){
                foreach ($architect_customers as $customer){
                    if ($customer->mobile == $request->mobile){
                        throw ValidationException::withMessages([
                            'mobile' => ['شما مشتری با این شماره قبلا در پنل خود ثبت کرده اید']
                        ]);
                    }
                }
            }
            $users = User::where('mobile', $request->mobile)->where('role', 'user')->get();
            $users2 = User::where('username', $username)->get();
            if (count($users) > 0 or count($users2) > 0) {
                foreach ($users as $user) {
                    if (Hash::check($password, $user->password)) {
                        throw ValidationException::withMessages([
                            'password' => ['خطایی رخ داد لطفا مجددا تلاش فرمایید']
                        ]);
                    }
                }
                foreach ($users2 as $user) {
                    if (Hash::check($password, $user->password)) {
                        throw ValidationException::withMessages([
                            'password' => ['خطایی رخ داد لطفا مجددا تلاش فرمایید']
                        ]);
                    }
                }
            }
            $slut = str_replace(' ', '-', $request->name);
            $customer =User::create([
                'name' => $request->name,
                'slut' => $slut,
                'mobile' => $request->mobile,
                'password' => Hash::make($password),
                'username' => $username,
                'city' => $city,
                'building' => $building,
                'identifier_id' => auth()->user()->id,
            ]);
            $text ="شرکت راکوین"."//"."\n".
                "نام کاربری:".$customer->mobile."//".
                "رمز عبور:".$password;
            $socialShare = \Share::page(
                $text,
                'شرکت راکوین',
            )
                ->facebook()
                ->twitter()
                ->reddit()
                ->linkedin()
                ->whatsapp()
                ->telegram();

            return view('architect.detailsOfNewCustomer',compact('customer','password','text','socialShare'));
        }
    }

    public function editCustomerPassword(Request $request)
    {
        $customers = auth()->user()->customers();
        if (count($customers)>0) {
            return view('architect.editCustomerPassword', compact('customers'));
        }else{
            $request->session()->flash('info', 'ابتدا یک مشتری معرفی کنید!');
            return redirect(route('define.customer'));
        }
    }

    public function storeCustomerPassword(Request $request)
    {
        if (auth()->user()->role == 'architect'){
            $customer = User::findOrFail($request->customerId);
            $newPassword = md5(uniqid());
            $users = User::where('mobile',$customer->mobile)
                ->orWhere('username',$customer->username)->get();
            foreach ($users as $user){
                if (Hash::check($newPassword, $user->password)) {
                    throw ValidationException::withMessages([
                        'password' => ['خطایی رخ داد لطفا مجددا تلاش فرمایید']
                    ]);
                }
            }
            $customer->update([
               'password' => Hash::make($newPassword),
            ]);
            $request->session()->flash('editCustomerPassword', $newPassword);
        }else{
            $request->session()->flash('error', "شما صلاحیت دریافت رمز عبور جدید را ندارید.");
        }
        return back();
    }

    public function totalCustomers()
    {
        $customers = User::where('role','user')->where('identifier_id',auth()->user()->id)->paginate(10);
        return view('architect.customers',compact('customers'));
    }
}
