<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('badges.index', ['badges' => $badges]);
    }

    public function show($slug)
    {
        $badge = Badge::where('slug' , $slug)->first();
        $users = $badge->load('users');
        return view('user.all-users', [
            'users'=> $users->users
        ]);
    }
}
