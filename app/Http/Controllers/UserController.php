<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function editProfile()
    {
        return view('general.editProfile');
    }

    public function storeEditProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150'],
        ]);
        $user = auth()->user();
        $name = $request->name;
        $city = ($request->city)? $request->city : null;
        $address = ($request->address)? $request->address : null;
        $building = ($request->building)? $request->building : null;
        $thumbnail = ($request->thumbnail)? $request->thumbnail : null;
        if ($request->name !== $user->name or $request->address !== $user->address or $request->city !== $user->city or $request->building !== $user->building or $request->thumbnail !== $user->thumbnail){
            $user->update([
                'name' => $name,
                'city' => $city,
                'address' => $address,
                'building' => $building,
                'thumbnail' => $thumbnail,
            ]);
        }
        $request->session()->flash('status', 'ویرایش اطلاعات با موفقیت انجام شد!');

        return back();

    }
}
