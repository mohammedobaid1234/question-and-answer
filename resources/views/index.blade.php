{{-- {{dd($tagsQuestions->questions)}} --}}
@extends('starter')
@section('header')
<div>
    <div class="header_main">
    <div>
        <h4>All Question</h4>
    </div>
    <div>
      <a href="{{route('questions.create')}}"  class="btn-group btn btn-primary">Ask Question</a>
    </div>
</div>


<div class="header_main">
    <div class="couns_question"><span>{{ $questions->total() }} questions</span></div>

</div>
</div>
@endsection
@section('questions')
{{-- {{dd($questions->count())}} --}}
@if ($questions->count() && isset($tagsQuestions)? $tagsQuestions->count() == 0 : 0)
    <div class="alert alert-warning">No Question To Show</div>
@endif
@php
    $count = 0;
@endphp
@foreach ($questions as $question)
    
<div class="main_main">
    <div class="question">
        <div class="left">
            <span>{{$question->votes}}</span>
            <div>Votes</div>
            <span>{{$question->answers()->count()}}</span>
            <div>answer</div>
           
            <div>{{$views[$count]}} views</div>
        </div>
        @php
            $count = $count + 1;
        @endphp
        <div class="right">
            <a href="{{route('questions.show', ['question' => $question->id])}}">{{$question->title}}</a>
            <p style="overflow: hidden; ">{{ @$question->body}}</p>
            <div class="tags">
                <x-tags-show :tags='$question->tags'/>
                {{-- <a href="">javascript</a>
                <a href="">html</a>
                <a href="">python-3x</a>
                <a href="">django</a>
                <a href="">django-models</a> --}}
                <div class="user_info">
                    <div>asked {{$question->updated_at->diffForHumans()}}</div>
                    <div class="user_last">
                        <div class="left"><img src="https://via.placeholder.com/50" alt=""></div>
                        <div class="right">
                            <div><a href="{{route('users.show' ,['user' => $question->user->id ])}}">{{$question->user->name}}</a></div>
                            <div>{{$question->user->votes}}</div>
                        </div>
                        <div class="cleatFix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearFix"></div>
    </div>
</div>
@endforeach
@if (isset($name) && isset($tagsQuestions))

@foreach ($tagsQuestions->questions as $question)
<div class="main_main">
    <div class="question">
        <div class="left">
            <span>{{$question->votes}}</span>
            <div>Votes</div>
            {{-- <span>{{$question->answers()->count()}}</span> --}}
            <div>answer</div>
            <div>2 views</div>
        </div>
        <div class="right">
            <a href="{{route('questions.show', ['question' => $question->id])}}">{{$question->title}}</a>
            <p style="overflow: hidden; ">{{ @$question->body}}</p>
            <div class="tags">
                <x-tags-show :tags='$question->tags'/>
                {{-- <a href="">javascript</a>
                <a href="">html</a>
                <a href="">python-3x</a>
                <a href="">django</a>
                <a href="">django-models</a> --}}
                <div class="user_info">
                    <div>asked 55 secs ago</div>
                    <div class="user_last">
                        <div class="left"><img src="https://via.placeholder.com/50" alt=""></div>
                        <div class="right">
                            <div><a href="{{route('users.show',['user' => $question->user->name])}}">{{$question->user->name}}</a></div>
                            <div>{{$question->user->votes}}</div>
                        </div>
                        <div class="cleatFix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearFix"></div>
    </div>
</div>
@endforeach
@endif
{{$questions->links()}}
@endsection