<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NavigationController extends Controller
{
    public function homePage(Request $request){
        $users = User::query()
        ->where('id', '!=', Auth::id()) 
        ->when($request->gender, function ($query) use ($request) {
            return $query->where('gender', $request->gender); 
        })
        ->when($request->hobby, function ($query) use ($request) {
            return $query->where('hobbies', 'like', '%' . $request->hobby . '%');
        })
        ->get();

        return view('welcome', compact('users'));
    }

    public function loginPage(){
        return view('pages.login');
    }

    public function registerPage(){
        $price = random_int(100000, 125000); 
        return view('pages.register', ['price' => $price]);
    }

    public function paymentPage(){
        $data = Session::get('registration_data');

        if (!$data) {
            return redirect()->route('register')->withErrors('Session expired. Please register again.');
        }

        return view('pages.payment', ['price' => $data['price']]);
    }

    public function buyAvatarPage(){
        $avatars = Avatar::all();

        return view('pages.buyAvatar', compact('avatars'));
    }

    public function topUpPage(){
        return view('pages.topUp');
    }
}
