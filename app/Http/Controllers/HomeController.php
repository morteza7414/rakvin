<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()){
            if (auth()->user()->role == "admin"){
                return view('admin.dashboard');
            }elseif (auth()->user()->role == "architect"){
                $ordersCount = 0;
                foreach (auth()->user()->customers() as $customer){
                    $ordersCount += count(Order::where('user_id',$customer->id)->get());
                }
                return view('architect.dashboard',compact('ordersCount'));
            }else{
                return view('customer.dashboard');
            }

        }else{
            return view('login');
        }

    }
}
