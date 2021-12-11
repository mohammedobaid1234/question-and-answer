    {{-- {{dd($user)}} --}}
    @extends('starter')
    @section('link')
    <link rel="stylesheet" href={{asset("assets/admin/css/main.css")}}>
    @php
        $noNotfication = 5;
    @endphp   
    @endsection
    @section('questions')
        <div class="bio">
            <div class="left-bio">
                <img src="https://via.placeholder.com/200" alt=""> 
                <div>
                    <div>
                        <div>
                            <h6>{{$user->votes}}</h6>
                            <span>reputation</span>
                        </div>
                        <div>
                            <h6>94.9m</h6>
                            <span>reached</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h6>{{$user->answers()->count()}}</h6>
                            <span>answers</span>
                        </div>
                        <div>
                            <h6>{{$user->questions()->count()}}</h6>
                            <span>questions</span>
                        </div>
                    </div>  
                    
                </div>
                
                
            </div>
            <div class="profile">
                <div>
                    <h3>{{$user->name}}</h3>
                    <a class="btn btn-outline-primary" href="">top 0,01% this year</a>
                </div>
                {{-- <span><i class="fas fa-location"></i> New York, United States</span> --}}
                <span><i class="fas fa-link"></i>{{$user->email}}</span>
                @if ($user->id == Auth::id())
                    
                <div class="edit"> <a href="" class="btn btn-outline-primary">edit bio</a></div>
                @endif
            </div>
        </div>
        <div class="intermediate">
            <div class="communities">
                <h5>Communities </h5>
                <div class="filed ">
                    <div><i class="fab fa-stack-overflow"></i>Stack Over Flow</div>
                    <div>1.1m</div>
                </div>
                <div class="filed">
                    <div><i class="fas fa-database"></i>Database Administrate</div>
                    <div>2.1k</div>
                </div>
                <div class="filed">
                    <div><i class="fas fa-comment"></i></i>Meta Stack Exchange</div>
                    <div>201</div>
                </div> 
            </div>
            <div class="badge">
                @foreach ($badges as $badge)
                <div><img width="100px" src={{$badge->image_url}} alt=""><a href="{{route('badges.show', ['slug' => $badge->slug])}}">{{$badge->name}}</a></div>
                    
                @endforeach
            </div>
        </div>
        <div class="top-question">
            {{-- {{dd($user->questions)}} --}}
            
            <div>
                <div><h5>Top Posts</h5></div>
                <div class="filter-div">
                    <div class="filter">
                        <a href="{{route('users.show' , ['user' => $user->id])}}">All</a>
                        <a href="{{route('users.show' , ['user' => $user->id , 'type'=>'question'])}}">Question</a>
                        <a href="{{route('users.show' , ['user' => $user->id , 'type'=>'answer'])}}">Answers</a>
                    </div>
                    <div class="filter">
                        <a href="{{URL(URL::current())}}?votes">Votes</a>
                        <a href="{{URL(URL::current())}}?newset">Newest</a>
                    </div>
                    
                </div>
            </div>
            {{-- {{dd($user->answers)}} --}}
            @if ($type == 'question')
                @foreach ($user->questions as $item)  
                <div>
                    <div>
                        <span class="btn btn-success">{{$item->votes}}</span>
                        <a href="{{route('questions.show' , ['question' => $item->id])}}"> {{$item->title}}</a>
                    </div>
                    <div>{{$item->created_at}}</div>
                </div>
                @endforeach
             @elseif ($type == 'answer')
                @foreach ($user->answers as $item) 
                    <div>
                        <div>
                            <span class="btn btn-success">{{$item->votes}}</span>
                            <a href="{{route('questions.show' , ['question' => $item->question->id])}}"> {{$item->question->title}}</a>
                        </div>
                        <div>{{$item->created_at}}</div>
                    </div>
                @endforeach
             @else
             @foreach ($user->questions as $item)  
                <div>
                    <div>
                        <span class="btn btn-success">{{$item->votes}}</span>
                        <a href="{{route('questions.show' , ['question' => $item->id])}}"> {{$item->title}}</a>
                    </div>
                    <div>{{$item->created_at}}</div>
                </div>
                @endforeach
             @foreach ($user->answers as $item) 
             <div>
                 <div>
                     <span class="btn btn-success">{{$item->votes}}</span>
                     <a href="{{route('questions.show' , ['question' => $item->question->id])}}"> {{$item->question->title}}</a>
                 </div>
                 <div>{{$item->created_at}}</div>
             </div>
             @endforeach
             
            @endif
        </div>
    <div class="clearFix"></div>
    @endsection