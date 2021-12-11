{{-- {{dd($questions)}} --}}

@extends('starter')
@section('style')
    <style>
      .couns_question  li{
            display: inline-block;
        }
        .question .left div {
            margin-bottom: 15px;
            margin-top: 20px;
        }
        .arrow-up {
            width: 44px;
            height: 0;
            border-left: 22px solid transparent;
            border-right: 24px solid transparent;
            border-bottom: 29px solid #a29090;
            background: #fff;
        }
        .arrow-down {
            width: 0; 
            height: 0; 
            border-left: 22px solid transparent;
            border-right: 24px solid transparent;
            background: #fff;
            border-top: 29px solid #a29090;
        }
        .mainVote{
            margin-top:22px;
            margin-left:-12px;
        }
    </style>
@endsection
@section('header')
<div>
    <div class="header_main">
    <div>
        <h3>{{$question->body}}</h3>

    </div>
    <div>
    </div>
</div>


<div class="header_main">
    <div class="couns_question" >
        {{-- <ul>
            <li>Asked at {{Carbon\Carbon::parse($question->created_at)->format('d/m/20y')}}</li>
            <li>dd</li>
            <li>dd</li>
            <li>dd</li>
        </ul> --}}
    </div>
 

</div>
</div>
@endsection
@section('questions')
<div class="main_main">
    
    <div class="question">
        <div class="left">
            <form class="votes" method="POST" action="{{route('votes.increase', [
                'type' => 'question',
                'id' => $question->id,
                // 'user_id' => Auth::user()->id ?? ''
                ])
            }}" >
                @csrf
                
                <button  type="submit" class="arrow-up"></button>
            </form>
            <div class="mainVote" style="=width: 37px; text-align: center;font-size: 35px; color : #aba0ad">{{$question->votes}}</div>
            <form class="votes" method="POST" action="{{route('votes.decrease', [
                'type' => 'question',
                'id' => $question->id,
                // 'user_id' => Auth::user()->id ?? ''
                ])
            }}" >
                @csrf

            <button type="submit" class="arrow-down"></button>
         </form>
        </div>
        <div class="right">
            <a href="{{route('questions.show', ['question' => $question->id])}}">{{$question->title}}</a>
            <p style="overflow: hidden; ">{{ $question->body}}</p>
            <div class="tags">
               <x-tags-show :tags='$question->tags'/>
                <div class="user_info">
                    <div>asked {{$question->updated_at->diffForHumans()}}</div>
                    <div class="user_last">
                        <div class="left"><img src="https://via.placeholder.com/50" alt=""></div>
                        <div class="right">
                            <div><a href="{{route('users.show', [$question->user_id])}}">{{$question->user->name}}</a></div>
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
<span>{{$question->answers()->count()}} answers</span>
@foreach ($question->answers as $answer)
    

<div class="main_main">
    <div class="question">
        <div class="left">
            <form  method="POST" action="{{route('votes.increase', [
                'type' => 'answer',
                'id' => $answer->id,
                // 'user_id' => Auth::user()->id ?? ''
                ])
            }}" >
                @csrf
                
                <button  type="submit" class="arrow-up"></button>
            </form>
          {{-- <a href=""  style="width: 0;color : #aba0ad"><i class="fas fa-caret-up fa-4x"></i></a> --}}
          <div style="    width: 37px; text-align: center;font-size: 35px; color : #aba0ad">{{$answer->votes}}</div>
          <form method="POST" action="{{route('votes.decrease', [
                'type' => 'answer',
                'id' => $answer->id,
                // 'user_id' => Auth::user()->id ?? ''
                ])
            }}" >
                @csrf

            <button type="submit" class="arrow-down"></button>
         </form>
          {{-- <a href="" style="width: 0;color : #aba0ad"><i class="fas fa-caret-down fa-4x"></i></a> --}}
        </div>
        <div class="right">
            <h5 >{{ $answer->body}}</h5>
            <div class="tags">
                
                <div class="user_info">
                    <div class="user_last">
                        <div>{{$answer->created_at->diffForHumans()}}</div>
                        <div class="left"><img src="https://via.placeholder.com/50" alt=""></div>
                        <div class="right">
                            <div><a href="{{route('users.show',$answer->user_id)}}">{{$answer->user->name}}</a></div>
                            <div>{{$answer->user->votes}}</div>
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
<div class="main_main" style="margin-top: 200px">
    <form action="{{route('answers.store', ['question_id' => $question->id])}} " method="POST">
        @csrf
        
        @include('questions/_form-answer',[
            'btn' => 'ADD Answer'
        ])

    </form>
</div>
@endsection
