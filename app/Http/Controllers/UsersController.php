<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //  public function fluter(Request $request, $user)
    // {
    //     if($request->has('newset')){
    //         dd($request);
    //         $user = $user->sortBy("created_at");
    //     }if($request->has('votes')){
    //         $user = $user->sortBy("votes");
    //     }else{
    //         return $user;
    //     }
    // }
    public function index(Request $request)
    {
        $users = User::all();
        return view('user.all-users' ,[
            'users' => $this->fluter($request,$users),
        ]);
    }
    public function getPage($name)
    {
        $userModel = User::where('name', '=', $name)->first();
        $numOfAnswer = $userModel->load(['answers','questions']);
        // dd($numOfAnswer);
        return view('user.index', [
            'user' => $numOfAnswer,
            
    ]);

    }
    public function show(Request $request,User $user , $type = null , $order = null)
    {
        
        
        $numOfAnswer = $user->load(['answers.question','questions']);
        // $numOfAnswer = $numOfAnswer->questions;
        // if($request->has('newset')){
        //     dd($request);
        //     $numOfAnswer = $numOfAnswer->sortBy("created_at");
        // }if($request->has('votes')){
        //     $numOfAnswer = $numOfAnswer->sortBy("votes");
        // }
        // return $numOfAnswer;
        $badges = $user->load('badges');
         $badges->distinct();
        return view('user.index', [
            'user' => $numOfAnswer,
            'type' => $type,
            'badges' => $badges->badges
    ]);
    }
    public function search(Request $request)
    {
        $name = strtolower($request->post('name'));
        // $users = User::where('name' , 'ilike', $name)->get();
        $users = User::whereRaw('lower(name) like (?)',["%{$name}%"])->get();
        return view('user.all-users' ,[
            'users' => $users
        ]);
        
    }
    public function hasAbility($ability)
    {
        // return true;
      $badges = $this->load('badges');
      dd($badges);
    }
}
