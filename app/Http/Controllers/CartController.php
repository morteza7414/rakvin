<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'imageId' => ['required', 'string', 'max:14'],
        ]);
        if (auth()->user()->role == "user") {
            $userId = auth()->user()->id;
            $cart = Cart::where('user_id', $userId)->where('image_id', $request->imageId)
                ->where('status', 1)->first();
            if (empty($cart)) {
                Cart::create([
                    'image_id' => $request->imageId,
                    'user_id' => $userId,
                ]);
            }else{
                $request->session()->flash('error', 'عکس مورد نظر در سبد سفارش موجود می باشد!');
            }
        }
        $request->session()->flash('status', 'عکس مورد نظر به سبد سفارش شما افزوده شد!');
        return back();
    }

    public function show()
    {
        $carts = auth()->user()->carts()->paginate(10);
        return view('customer.carts',compact('carts'));
    }

    public function delete($id,Request $request)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->user_id == auth()->user()->id){
            $cart->delete();
        }
        $request->session()->flash('status', 'عکس مورد نظر از سبد سفارش شما حذف شد!');
        return back();
    }

}
