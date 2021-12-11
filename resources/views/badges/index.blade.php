 @extends('starter')
 @section('style')
     <style>
         .users {
                display: flex;
            }
 
     </style>
 @endsection
@section('link')
<link rel="stylesheet" href={{asset("assets/admin/css/main.css")}}>
@php
    $noNotfication = 5;
@endphp   
@endsection
@section('questions')
@foreach ($badges as $badge)
<div style="display:flex ;margin-right: 10px;" >
    <div class="badge" >
        <div class=""><img width="100px" src={{$badge->image_url}} alt=""></div>
        <div class="">
            <div><a href="{{route('badges.show', ['slug' => $badge->slug])}}">{{$badge->name}}</a></div>
        </div>
        <div class="cleatFix"></div>
    </div>
    
</div>
@endforeach
@endsection