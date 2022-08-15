<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Images;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AlbumController extends Controller
{
    public function getAlbums()
    {
        if (auth()->user()->role == "architect") {
            $albums = auth()->user()->albums()->paginate(9);
        } else {
            $albums = auth()->user()->customerAccessibleAlbums()->paginate(9);
        }
        return view('album.albums', compact('albums'));
    }

    public function showImages($id, $slut, Request $request)
    {
        $album = Album::findOrFail($id);
        if ($album->slut == $slut) {
            $images = $album->images;
            return view('album.images', compact('images', 'album'));
        }
        $request->session()->flash('error', 'شما دسترسی لازم به این آلبوم را ندارید');
        return back();
    }

    public function defineAlbum(Request $request)
    {
        $architects = User::where('role', 'architect')->get();
        if (count($architects) > 0 ) {
            return view('admin.defineAlbum');
        } else {
            $request->session()->flash('info', 'برای تعریف آلبوم باید حداقل یک طراح داشته باشید!');
            return redirect(route('define.architect'));
        }
    }


    public function storeAlbum(Request $request)
    {
        $request->validate([
            'architect' => ['required', 'max:14'],
            'album_name' => ['required', 'string', 'max:150'],
        ]);
        $architect = User::findOrFail($request->architect);
        if (empty($architect->albums()->where('name', $request->album_name)->first())) {
            $slut = str_replace(' ', '-', $request->album_name);
            $album = Album::create([
                'name' => $request->album_name,
                'slut' => $slut,
                'architect_id' => $request->architect,
            ]);
            $request->session()->flash('status', 'آلبوم با موفقیت اضافه شد لطفا عکس های آلبوم را انتخاب کنید');
            return redirect(route('addImagesToAlbum', $album->id));
        } else {
            throw ValidationException::withMessages([
                'album_name' => ['آلبومی با همین نام قبلا برای این طراح ثبت شده است']
            ]);
        }
    }

    public function addImagesToAlbum($album)
    {
        $album = Album::findOrFail($album);
        return view('admin.addImagesToAlbum', compact('album'));
    }

    public function storeImages(Request $request)
    {
        $request->validate([
            'album' => ['required', 'string', 'max:14'],
        ]);
        $album_id = $request->album;
        $album = Album::findOrFail($album_id);
        $architect = $album->architect;
        $count = count($request->all());
        for ($i = 1; $i < $count; $i++) {
            $x = "image" . $i;
            $image = $request->$x;
            if (!empty($image)) {
                $request->validate([
                    $x => ['required', 'string', 'max:100'],
                ]);
                $slut = str_replace(' ', '-', $image);
                Images::create([
                    'album_id' => $album_id,
                    'url' => $image,
                    'slut' => $slut,
                    'user_id' => $architect->id,
                ]);
            }
        }
        $request->session()->flash('status', 'تصاویر آلبوم با موفقیت ذخیره شدند');
        return back();
    }

    public function showAlbumImages(Request $request)
    {
        if (auth()->user()->role == "admin") {
            $albums = Album::all();
        } elseif (auth()->user()->role == "architect") {
            $albums = auth()->user()->albums;
        } else {
            $albums = auth()->user()->customerAccessibleAlbums;
        }
        foreach ($albums as $album) {
            if ($album->id == $request->albumId) {
                $images = $album->images;
                return view('album.images', compact('images', 'album'));
            }
        }
        $request->session()->flash('error', 'شما دسترسی لازم به این آلبوم را ندارید');
        return back();

    }

    public function deleteAlbumImage(Request $request, $id)
    {
        $image = Images::findOrFail($id);
        $image->delete();
        $request->session()->flash('info', 'عکس مورد نظر شما حذف شد!');
        return back();
    }


    public function albumAccessible($id)
    {
        $album = Album::findOrFAil($id);
        $customers = auth()->user()->customers();
        return view('architect.setAlbumAccessible', compact('album', 'customers'));
    }

    public function storeAlbumAccessible(Request $request, $albumId)
    {
        $album = Album::findOrFail($albumId);
        $slut = $album->slut;
        $architectCustomers = auth()->user()->customers();
        foreach ($architectCustomers as $customer) {
            $customerId = $customer->id;
            $requestName = "isAccess" . $customerId;
            if ($request->$requestName) {
                if (!$customer->isAccessToAlbum($albumId)) {
                    DB::insert('insert into users_albums_accessable (user_id, album_id) values (?, ?)', [$customerId, $albumId]);
                }
            } else {
                if ($customer->isAccessToAlbum($albumId)) {
                    DB::table('users_albums_accessable')
                        ->where('user_id', $customerId)
                        ->where('album_id', $albumId)->delete();
                }
            }
        }
        $request->session()->flash('status', 'ویرایش دسترسی به آلبوم مورد نظر انجام شد!');
        return redirect(route('get.album.images', ['id' => $albumId, 'slut' => $slut]));
    }

    public function customerAccessible($id)
    {
        $customer = User::findOrFail($id);
        $albums = auth()->user()->albums;
        return view('architect.setCustomerAccessible', compact('customer', 'albums'));
    }

    public function storeCustomerAccessible(Request $request, $customerId)
    {
        $customer = User::findORFail($customerId);
        $architectAlbums = auth()->user()->albums;
        foreach ($architectAlbums as $album) {
            $albumId = $album->id;
            $requestName = "isAccess" . $albumId;
            if ($request->$requestName) {
                if (!$customer->isAccessToAlbum($albumId)) {
                    DB::insert('insert into users_albums_accessable (user_id, album_id) values (?, ?)', [$customerId, $albumId]);
                }
            } else {
                if ($customer->isAccessToAlbum($albumId)) {
                    DB::table('users_albums_accessable')
                        ->where('user_id', $customerId)
                        ->where('album_id', $albumId)->delete();
                }
            }
        }
        $request->session()->flash('status', 'ویرایش دسترسی به آلبوم ها برای مشتری مورد نظر انجام شد!');
        return redirect(route('total.customers'));
    }
}
