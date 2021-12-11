<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::with('questions')
        ->orderBy('created_at')
        ->get();
        // return $tags;
        return view('tags.all-tags', [
            'tags' => $tags
        ]);
    }
    public function search(Request $request)
    {
        $name = strtolower($request->post('name'));
        // $tags = User::where('name' , 'ilike', $name)->get();
        $tags = Tag::whereRaw('lower(name) like (?)',["%{$name}%"])->get();
        return view('tags.all-tags' ,[
            'tags' => $tags
        ]);
    }
}
