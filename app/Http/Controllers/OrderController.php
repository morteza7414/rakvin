<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('order.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:1500'],
            'building' => ['required', 'string', 'max:150'],
            'city' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:15'],
        ]);
        $user = auth()->user();
        $user_id = $user->id;
        $building = $request->building;
        $address = $request->address;
        $city = $request->city;
        $mobile = $user->mobile;
        $phone = $request->phone;
        $has_logo = ($request->hasLogo)? true : false;
        $want_logo = ($request->wantLogo)? true : false;
        $carts = $user->carts()->where('status','1')->get();
        $description = (!empty($request->description))? $request->description : null;

        if (!empty($request->logo)){
            $user->uploads()->create([
                'user_id' => $user_id,
                'url' => $request->logo,
            ]);
        }
        $order = Order::create([
            'user_id' => $user_id,
            'building' => $building,
            'address' => $address,
            'city' => $city,
            'mobile' => $mobile,
            'phone' => $phone,
            'has_logo' => $has_logo,
            'want_logo' => $want_logo,
            'carts' => $carts,
            'description' => $description,
        ]);
        foreach ($carts as $cart){
            $cart->update([
                'order_id' => $order->id,
                'status' => 2,
            ]);
        }

        $user->update([
           "city" => $city,
           "phone" => $phone,
           "building" => $building,
           "address" => $address,
        ]);
        $request->session()->flash('status', 'سفارش شما با موفقیت ثبت شد');
        return redirect(route('home'));
    }

    public function total()
    {
        if (auth()->user()->role == "user"){
            $orders = Order::where('user_id', '=' ,auth()->user()->id)->paginate(10);
        }else{
            return back();
        }

        return view('order.orders',compact('orders'));


    }

    public function getOrders($type)
    {
        if ($type == "new"){
            $orders = Order::where('status',1)->orderBy('created_at','DESC')->paginate(10);
        }elseif ($type == "total"){
            $orders = Order::where('status','!=','1')->orderBy('created_at','DESC')->paginate(10);
        }
        return view('order.orders',compact('orders'));
    }

    public function delete($id,Request $request)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        $request->session()->flash('info', 'سفارش شما حذف شد');
        return back();
    }

    public function show($id,Request $request)
    {
        $order = Order::findOrFail($id);
        $counter =1;

        return view('order.single',compact('order','counter'));
    }

    public function submit($id,Request $request)
    {
        $order = Order::findOrFail($id);
        if (auth()->user()->role == "admin"){
            $order->update([
                'status' => 2,
            ]);
            $request->session()->flash('status', 'سفارش شما با موفقیت تایید شد');
            return redirect(route('orders.get',['type'=>'new']));
        }else{
            abort('403','شما به این بخش دسترسی ندارید!');
        }

    }


}
