<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserAccountController extends Controller
{
    public function create()
    {
        return Inertia('UserAccount/create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required|min:5|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));

        Auth::login($user);

        return redirect()->route('listing.index')->with('success', 'Account created!');
    }
}
