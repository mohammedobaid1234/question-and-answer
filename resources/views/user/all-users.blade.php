    @extends('starter')
    @section('link')
    <link rel="stylesheet" href={{asset("assets/admin/css/main.css")}}>
    @php
        $noNotfication = 5;
    @endphp   
    @endsection
    @section('style')
    <style>
        .users > div{
          width: 330px;
        }
        .users div img{
            margin: 0 5px 10px 0;
            width: 95px;
        }
        .users {
            display: flex;
            flex-wrap: wrap;

        }
        
        .user_last{
            margin-top: 10px;
        }
        .user_last .left{
            width: auto;
        }
        .user_last .right{
            width: auto;
        }
        .user_last{
            display: flex;
            flex-basis:100px
        }
    </style>
    @endsection

    @section('header')
        <form style="margin-bottom: 20px;" action="{{route('users.search')}}" method="GET" class="form-inline my-2 my-lg-0">
            {{-- @csrf --}}
            <input class="form-control mr-sm-2" type="search" name="name" placeholder="Enter User Name" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    @endsection

    @section('questions')
    {{-- {{dd($users->count())}} --}}
    @if ($users->count() > 0)
    @foreach ($users as $user)
        
    <div class="user_info">
        <div class="user_last">
            <div class="left"><img src="https://via.placeholder.com/100" alt=""></div>
            <div class="right">
                <div><a href="{{route('users.show', ['user'=>$user->id])}}">{{$user->name}}</a></div>
                <div>{{$user->email}}</div>
                <div>{{$user->votes}}</div>
            </div>
            <div class="cleatFix"></div>
        </div>
    </div>
    @endforeach
    @elseif($users->count() == 0)
        <div style="width: 100%; padding:10px; margin:10px; text-align:center;font-weight:600 ;font-size:18px" class="aleart alert-danger">Sorry Not Found Any User</div>
     @endif   
    @endsection
