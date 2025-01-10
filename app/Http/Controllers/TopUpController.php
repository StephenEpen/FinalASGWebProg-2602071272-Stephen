<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function topUp()
    {
        $user = User::find(Auth::id());

        $user->update([
            'wallet_balance' => $user->wallet_balance + 100,
        ]);

        return redirect()->back()->with('success', '100 coins have been added to your balance!');
    }
}
