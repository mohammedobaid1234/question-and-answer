
@extends('starter')
@section('header')
<div>
    <div class="header_main">
    <div>
        <h2>Questions tagged [{{$tag_name}}]</h2>
    </div>
    
</div>


<div class="header_main">
    {{-- <div class="couns_question"><span>{{$questions->total()}} questions</span></div> --}}

</div>
</div>
@endsection
@section('questions')
    

@foreach ($questions->questions as $question)
  

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
            <p style="overflow: hidden; ">{{ $question->body}}</p>
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
                            <div><a href="">{{$question->user->name}}</a></div>
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
{{-- {{$questions->links()}} --}}

@endsection