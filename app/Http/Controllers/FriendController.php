<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function sendRequest(Request $request, $friend_id)
    {
        $user = Auth::user();

        $existingFriendship = Friend::where(function ($query) use ($user, $friend_id) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $friend_id)
                ->where('status', 'accepted');
        })->orWhere(function ($query) use ($user, $friend_id) {
            $query->where('user_id', $friend_id)
                ->where('friend_id', $user->id)
                ->where('status', 'accepted');
        })->exists();

        if ($existingFriendship) {
            return redirect()->back()->with('error', 'You are already friends.');
        }


        $existingRequest = Friend::where('user_id', $user->id)
            ->where('friend_id', $friend_id)
            ->exists();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Friend request already sent.');
        }

        Friend::create([
            'user_id' => $user->id,
            'friend_id' => $friend_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Friend request sent successfully.');
    }

    public function acceptRequest($request_id)
    {
        $friendRequest = Friend::findOrFail($request_id);

        if ($friendRequest->friend_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $friendRequest->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Friend request accepted.');
    }

    public function rejectRequest($request_id)
    {
        $friendRequest = Friend::findOrFail($request_id);

        if ($friendRequest->friend_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $friendRequest->delete();

        return redirect()->back()->with('success', 'Friend request rejected.');
    }

    public function unfriend($friend_id)
    {
        $user = Auth::user();

        $friendship = Friend::where(function ($query) use ($user, $friend_id) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $friend_id);
        })->orWhere(function ($query) use ($user, $friend_id) {
            $query->where('user_id', $friend_id)
                ->where('friend_id', $user->id);
        })->first();

        if ($friendship) {
            $friendship->delete();

            return redirect()->back()->with('success', 'You have unfriended this user.');
        }

        return redirect()->back()->with('error', 'Friendship not found.');
    }


    public function listFriends()
    {
        $user = Auth::user();

        $friendships = Friend::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('friend_id', $user->id);
        })->where('status', 'accepted')->get();

        $friends = $friendships->map(function ($friendship) use ($user) {
            return $friendship->user_id === $user->id
                ? User::find($friendship->friend_id)
                : User::find($friendship->user_id);
        });

        return view('pages.profilePage', compact('friends'));
    }
}
