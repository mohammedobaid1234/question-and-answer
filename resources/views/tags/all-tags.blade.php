@extends('starter')
@section('link')
<link rel="stylesheet" href={{asset("assets/admin/css/main.css")}}>
@php
    $noNotfication = 5;
@endphp   
@endsection
@section('style')
<style>
        .users{
        margin: 10px;
        }
        .users > div{
            width: 245px;
        }
        .users div img{
            margin: 0 5px 10px 0;
            width: 95px;
        }
        .users {
            display: flex;
            flex-wrap: wrap;
            
        }
        .user_last .left{
            width: auto;
        }
        .user_last{
            display: flex;
            flex-basis:100px
        }
    .tag{
        border: 1px solid #ddd;
        margin: 10px;
        padding: 10px;
    }
    .tag > span{
        display: inline-block;
       background-color: #e1ecf4;
       color: #39739d;
       padding: 5px;
       margin-bottom: 8px;
       /* margin: 10px; */
    }
    .tag p{
        color: #333;
        font-size: 15px;
    }
    .tag div{
        color: rgb(194, 187, 187);
    }
</style>
@endsection

@section('header')
    <form style="margin-bottom: 20px;" action="{{route('tags.search')}}" method="GET" class="form-inline my-2 my-lg-0">
        {{-- @csrf --}}
        <input class="form-control mr-sm-2" type="search" name="name" placeholder="Enter Tag Name" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
@endsection

@section('questions')
{{-- {{dd($tags->count())}} --}}
@if ($tags->count() > 0)
@foreach ($tags as $tag)
<div class="tag">
    <span ><a href="{{route('questions.tagged', ['name' => $tag->name])}}">{{$tag->name}}</a></span>
    
    <p>
       {{$tag->description}}
    </p>
    <div>
        <span>{{$tag->questions()->count()}}</span> question
    </div>
</div>

@endforeach
@elseif($tags->count() == 0)
    <div style="width: 100%; padding:10px; margin:10px; text-align:center;font-weight:600 ;font-size:18px" class="aleart alert-danger">Sorry Not Found Any Tags</div>
 @endif   
@endsection
