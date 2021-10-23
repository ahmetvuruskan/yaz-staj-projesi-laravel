<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function index()
    {
        $count['product'] = Product::all()->count();
        $count['orders']=Orders::all()->count();
        $count['sales'] = Orders::sum('amount');
        return view('Admin.index')->with('count',$count);
    }

    public function profile()
    {
        return view('Admin.user');
    }

    public function updateUser(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'password' => 'bail|required_with:current_password|min:8|max:16|confirmed',
            'user_photo' => 'bail|image|max:2048'
        ], [
            'password.min' => 'Yeni parolanız en az 8 haneli olmalıdır.',
            'password.max' => 'Yeni parolanız en fazla 16 haneli olmalıdır.',
            'password.confirmed' => 'Girilen parolalar uyuşmuyor.',
            'password.required_with' => 'Yeni şifre alanı gereklidir.',
            'user_photo.image' => 'Yüklemeye çalıştığınız dosyanın formatı hatalıdır.',
            'user_photo.max' => 'Yüklemeye çalıştığınız dosya maximum 2 mb olmalıdır'
        ]);
        if ($validation->fails()) {
            return redirect(route('admin.profile'))->withErrors($validation);
        }

        if (Hash::check($request->current_password, Auth::user()->getAuthPassword())) {
            $update = User::where('id', Auth::id())->update([
                'password' => bcrypt($request->password)
            ]);
        }
        if ($request->hasFile('user_photo')) {
            $image = $request->file('user_photo');
            $filePath = public_path('images\users');
            $fileName = uniqid('USR-PHOTO-') . '.' . $image->extension();
            $img = Image::make($image->getRealPath());
            $img->resize(140, 140, function ($const) {
            })->save($filePath . '/' . $fileName);
            $update = User::where('id', Auth::id())->update([
                'user_photo' => $fileName
            ]);

        }
        if ($update) {
            if (file_exists(public_path('/images/users/' . $request->old_file))) {

                @unlink(public_path('/images/users/' . $request->old_file));
            }
            return redirect(route('admin.profile'))->with('success', 'Kullanıcı bilgileri başarı ile düzenlendi');
        }
        return redirect(route('admin.profile'))->with('error', 'Kullanıcı düzenleme başarısız');
    }

    public function login()
    {
        return view('Admin.login');
    }

    public function loginCheck(Request $request)
    {
        $validateUserData = Validator::make($request->all(), [
            'email' => 'bail|required|email|',
            'password' => 'bail|required'
        ], [
            'email.required' => 'Email alanı boş geçilemez.',
            'email.email' => 'Girdiğiniz değer bir mail adresi değildir.',
            'password.required' => 'Şifre alanı boş geçilemez.'
        ]);
        if ($validateUserData->fails()) {
            return redirect(route('admin.login'))->withErrors($validateUserData);
        }

        $rememberMe = $request->has('remember_me') ? true : false;
        $request->flash();
        $userData = $request->only('email', 'password');
        if (Auth::attempt($userData, $rememberMe)) {
            return redirect()->route('admin.index');
        } else {
            return back()->with('error', 'Hatalı kullanıcı');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.login'));
    }
}
