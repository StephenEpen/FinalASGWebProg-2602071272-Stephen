<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function buyAvatar(Request $request, $avatarId)
    {
        $user = User::find(Auth::id());

        $avatar = Avatar::find($avatarId);

        if (!$avatar) {
            return redirect()->back()->withErrors('Avatar tidak ditemukan.');
        }

        if ($user->wallet_balance < $avatar->price) {
            return redirect()->back()->withErrors('Koin Anda tidak cukup untuk membeli avatar ini.');
        }

        $user->update([
            'wallet_balance' => $user->wallet_balance - $avatar->price,
            'profile_picture' => $avatar->image_url,
        ]);

        return redirect()->back()->with('success', 'Avatar berhasil dibeli dan diterapkan ke profil Anda!');
    }
}
