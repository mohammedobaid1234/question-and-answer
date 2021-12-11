<?php

namespace App\Http\Controllers;

use App\Events\VoteCreatedEvent;
use App\Events\VoteIncrease;
use App\Listeners\SendNotifyListener;
use App\Models\Achieve;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class VoteController extends Controller
{
    public function increase(Request $request, $type, $id)
    {
        // dd($request);
        $this->authorize('create', Vote::class);
        // if(!$this->authorize('create', Vote::class)){
        //     dd('ddd');
        // }
        $user_id = Auth::id();
        if($user_id == null){
            abort(403);
        }
        $question = Question::findOrFail($id);
        // dd($question->user_id);
        if($question->user_id === Auth::id()){
            
            return redirect()->back();
        }
        if($type == 'question'){
            $votes = Vote::where(['user_id' => Auth::id(),'votes_type'=>'question','votes_id'=>$id ])->first();
            // event('VoteCreated', ['increase' , $id]);
            
            // dd($votes);
            if(!$votes){
              
                Vote::updateOrCreate(
                    [
                        'user_id' => $user_id,
                        'votes_type' => 'question',
                        'votes_id' => $id
                    ],
                    [
                         'votes' => DB::raw('votes+' . 1),
                    ]
                );
                // dd('dd');
                $user = Question::findOrFail($id);
                $vote = $user->votes;
                $newVote = $vote+1;
                $user->update(['votes' => $newVote]);
                $this->increaseVotes($user);
                $this->updateBade($user);
                if($request->expectsJson()){

                    return $user;
                }
                return redirect()->back();
                
            }else{
                // dd($votes->votes);
                if($votes->votes >= 1) {
                    if($request->expectsJson()){

                        // return $user;
                        return Question::findOrFail($id);
                    }

                    redirect()->back();
                }else{
                    Vote::updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'votes_type' => 'question',
                            'votes_id' => $id
                        ],
                        [
                             'votes' => DB::raw('votes+' . 1),
                        ]
                    );
    
                    $user = Question::findOrFail($id);
                    $vote = $user->votes;
                    $newVote = $vote+1;
                    $user->update(['votes' => $newVote]);
                     $this->increaseVotes($user);
                     $this->updateBade($user);
                     if($request->expectsJson()){

                        return $user;
                    }

                    return redirect()->back();

                }
                
            }
            
            return redirect()->back();
        }
        if($type == 'answer'){
            $votes = Vote::where(['user_id' => Auth::id(),'votes_type'=>'answer','votes_id'=>$id ])->first();
            
            if(!$votes){
                // dd($id);
              
                Vote::updateOrCreate(
                    [
                        'user_id' => $user_id,
                        'votes_type' => 'answer',
                        'votes_id' => $id
                    ],
                    [
                         'votes' => DB::raw('votes+' . 1),
                    ]
                );
                    // dd($id);
                $user = Answer::findOrFail($id);
                $vote = $user->votes;
                $newVote = $vote+1;
                // dd($newVote);

                $user->update(['votes' => $newVote]);
                 
                return redirect()->back();
                // dd($type);  
            }else{
                
                if($votes->votes >= 1) {
                    // dd('vote');s
                    redirect()->back();
                }else{
                    Vote::updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'votes_type' => 'answer',
                            'votes_id' => $id
                        ],
                        [
                             'votes' => DB::raw('votes+' . 1),
                        ]
                    );
    
                    $user = Answer::findOrFail($id);
                    $vote = $user->votes;
                    $newVote = $vote+1;
                    $user->update(['votes' => $newVote]);
                     
                    return redirect()->back();

                }
                
            }
            return redirect()->back();
        }
        
    }
    public function decrease(Request $request, $type, $id)
    {
        $this->authorize('create', Vote::class);

        $user_id = Auth::id();
        if($type == 'question'){
            $votes = Vote::where(['user_id' => Auth::id(),'votes_type'=>'question','votes_id'=>$id ])->first();
            
            // dd($votes);
            if(!$votes){
              
                Vote::updateOrCreate(
                    [
                        'user_id' => $user_id,
                        'votes_type' => 'question',
                        'votes_id' => $id
                    ],
                    [
                         'votes' => DB::raw('votes-' . 1),
                    ]
                );

                $user = Question::findOrFail($id);
                $vote = $user->votes;
                $newVote = $vote-1;
                $user->update(['votes' => $newVote]);
                $this->decreaseVotes($user);
                $this->updateBade($user);
                if($request->expectsJson()){

                    return $user;
                }
                return redirect()->back();
                // dd($type);  
            }else{
                // dd($votes->votes);
                if($votes->votes == -1) {
                    if($request->expectsJson()){
                    return Question::findOrFail($id);
                     
                }
                    redirect()->back();
                }else{
                    
                    Vote::updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'votes_type' => 'question',
                            'votes_id' => $id
                        ],
                        [
                             'votes' => DB::raw('votes-' . 1),
                        ]
                    );
    
                    $user = Question::findOrFail($id);
                    $vote = $user->votes;
                    $newVote = $vote-1;
                    $user->update(['votes' => $newVote]);
                    $this->decreaseVotes($user);
                    $this->updateBade($user);
                    if($request->expectsJson()){

                        return $user;
                    }
                    return redirect()->back();

                }
                
            }
            
            return redirect()->back();
        }
        if($type == 'answer'){
            $votes = Vote::where(['user_id' => Auth::id(),'votes_type'=>'answer','votes_id'=>$id ])->first();
            
            if(!$votes){
                // dd($id);
              
                Vote::updateOrCreate(
                    [
                        'user_id' => $user_id,
                        'votes_type' => 'answer',
                        'votes_id' => $id
                    ],
                    [
                         'votes' => DB::raw('votes-' . 1),
                    ]
                );
                    // dd($id);
                $user = Answer::findOrFail($id);
                $vote = $user->votes;

                $newVote = $vote-1;
                // dd($newVote);

                $user->update(['votes' => $newVote]);
                 
                return redirect()->back();
                // dd($type);  
            }else{
                
                if($votes->votes == -1) {
                    
                    redirect()->back();

                }else{
                    Vote::updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'votes_type' => 'answer',
                            'votes_id' => $id
                        ],
                        [
                             'votes' => DB::raw('votes-' . 1),
                        ]
                    );
    
                    $user = Answer::findOrFail($id);
                    $vote = $user->votes;
                    $newVote = $vote-1;
                    // dd($newVote);
                    
                    $user->update(['votes' => $newVote]);
                    $user->save();
                    return redirect()->back();

                }
                
            }
            return redirect()->back();
        }
    }
    public function updateBade(Question $question)
    {   
        $user = Auth::user();
        if($user->votes == 10){
            Achieve::Create([
                    'user_id' => Auth::id(),
                    'badge_id' => 3
                ]);
            }elseif($user->votes == 5){
                Achieve::Create([
                        'user_id' => Auth::id(),
                        'badge_id' => 2
                    ]);
        }elseif($user->votes == 0){
            Achieve::Create([
                    'user_id' => Auth::id(),
                    'badge_id' => 1
                ]);
        }
        $user_id = $question->user_id;
        $user1 = User::where('id', $user_id)->first(); 
        if($user1->votes == 10){
            Achieve::Create([
                    'user_id' => $user1->id,
                    'badge_id' => 3
                ]);
            }elseif($user1->votes == 5){
                Achieve::Create([
                        'user_id' => $user1->id,
                        'badge_id' => 2
                    ]);
        }elseif($user->votes == 0){
            Achieve::Create([
                    'user_id' => $user1->id,
                    'badge_id' => 1
                ]);
        }
    }
    // public function decreaseBadge($question)
    // {
    //     $votes = Auth::user()->votes;
    //     if($votes == 8){

    //     }
    // }
    public function increaseVotes(Question $question)
    {
        $user = Auth::user();
        $user1 = $question->user_id;
        
        $votes = $user->votes;
        // dd($votes);
        $votes = $votes + 1;
        $vote1= User::where('id',$user1)->first();
        $vote1 = $vote1->votes;
        $vote1 =$vote1 +1;
        // dd($vote1);
        DB::table('users')->where('id', $user->id)->update(['votes' => $votes]);
        DB::table('users')->where('id', $user1)->update(['votes' => $vote1]);
    }
    public function decreaseVotes(Question $question)
    {
        $user = Auth::user();
        $user1 = $question->user_id;
        
        $votes = $user->votes;
        $votes = $votes - 1;
        $vote1= User::where('id',$user1)->first();
        $vote1 = $vote1->votes;
        $vote1 =$vote1 - 1;
        // dd($vote1);
        DB::table('users')->where('id', $user->id)->update(['votes' => $votes]);
        DB::table('users')->where('id', $user1)->update(['votes' => $vote1]);
    }
}
