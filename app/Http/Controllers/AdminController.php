<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{


    public function defineArchitect()
    {
        return view('admin.defineArchitect');
    }

    public function storeArchitect(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:14'],
            'name' => ['required', 'string', 'max:150'],
        ]);
        $mobile = $request->mobile;
        if (auth()->user()->role == "admin") {
            $user = User::where('role', 'architect')->where('mobile', $mobile)->first();
            if ($user) {
                $request->session()->flash('error', 'طراحی با این شماره موبایل قبلا ثبت شده است!');
            } else {
                $password = md5(uniqid());
                $slut = str_replace(' ', '-', $request->name);
                $architect = User::create([
                    'name' => $request->name,
                    'slut' => $slut,
                    'mobile' => $mobile,
                    'panel_username' => $mobile,
                    'password' => $password,
                    'role' => 'architect',
                    'identifier_id' => auth()->user()->id,
                ]);

                $text ="شرکت راکوین"."//"."\n".
                    "نام کاربری:".$architect->mobile."//".
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

                return view('admin.detailsOfNewArchitect',compact('architect','password','text','socialShare'));

            }

        } else {
            $request->session()->flash('error', 'شما دسترسی لازم را ندارید!');
            return back();
        }

    }

    public function editArchitectPassword($id)
    {
        $architect = User::findOrFail($id);
        return view('admin.changeArchitectPassword', compact('architect'));

    }
//    public function editArchitectPassword(Request $request)
//    {
//        $architects = auth()->user()->architects();
//        if (count($architects)>0){
//        return view('admin.changeArchitectPassword', compact('architects'));
//        }else{
//            $request->session()->flash('info', 'ابتدا یک طراح معرفی کنید!');
//            return redirect(route('define.architect'));
//        }
//    }

    public function storeArchitectPassword(Request $request)
    {
        $request->validate([
            'architect' => ['required', 'string', 'max:14'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
        ]);
        $architect = User::findOrFail($request->architect);
        $password = Hash::make($request->password);
        if (auth()->user()->role == "admin") {
            $architect = $architect->update([
                "password" => $password,
            ]);
            $request->session()->flash('status', 'رمز عبور طراح مورد نظر ویرایش شد!');
        }
        return redirect(route('home'));

    }

    public function getArchitectForAlbum()
    {
        return view('admin.getArchitectForAlbums');
    }

    public function getAlbumsForAdmin(Request $request)
    {
        if ($request->architectId == "all") {
            $architect = "all";
            $albums = Album::paginate(9);
        }else{
            $architect = User::findOrFail($request->architectId);
            $albums = $architect->albums()->paginate(9);
        }

        return view('album.albums',compact('albums','architect'));
    }

    public function architectsList()
    {
        $architects = User::where('role','architect')->paginate(10);
        return view('admin.architects',compact('architects'));
    }

    public function singleArchitect($id,Request $request)
    {
        $architect = User::findOrFail($id);
        return view('admin.singleArchitect',compact('architect'));
    }

    public function detailArchitect()
    {
        $architect = User::where('role','architect')->first();
        $password = 33333333;
        $text ="شرکت راکوین"."//"."\n".
                "نام کاربری:".$architect->mobile."//".
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

        return view('admin.detailsOfNewArchitect',compact('architect','password','text','socialShare'));
    }


}
