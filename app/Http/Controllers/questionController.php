<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Achieve;
use App\Models\Answer;
use App\Models\Tag;
use App\Models\TagQuestion;
use App\Models\User;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class questionController extends Controller
{   
    protected $view =[];
    protected $name ='views';
     public function __construct()
    {
        $this->middleware('auth')->except('index','show','search');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Achieve::truncate();
        $views =[];
        $questions = Question::with(['user','tags','answers'])->paginate(5); 
        foreach($questions as  $question){
            $views[] = $this->getNumberOfView($question->id);
        }
        // return $views;
        // return $questions->answers;
        return view('index',[
            'questions' => $questions,
            'views' => $views
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $question = new Question();
        $tags = Tag::orderBy('created_at')->limit(9)->pluck('name');
        return view('questions/create', [
            'question' => $question,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {  
        // store the new question
        $newQuestion =  Question::create($request->toArray());
        $question_id = $newQuestion->id;
        // get basic Tags => get Tags From request as String => make explode ',' 
        //=> check if tag in request exist in basic Tags => Store ☺
        $baseTags = Tag::pluck('name')->toArray();
        $tags = $request->post('tags');
        $tags = str_replace(' ', '' ,$tags);
        $tags = explode(',',$tags);
        foreach($tags as $tag){
            if(in_array($tag , $baseTags)){
                $newTag = Tag::where('name' , $tag)->first()->id; 
                $newQuestionTag =  TagQuestion::create([
                    'question_id' => $question_id,
                    'tag_id' => $newTag,
                ]);
                $newQuestionTag->save();
            }
        }
        
        // $newQuestion->save();
        // // dd($request);
        
        // $tagName = Tag::where('name' ,'=', strtolower($request->tags))->first();
        
        // if($tagName != null){
        //     $request->merge([
        //         'question_id' => $newQuestion->id,
        //         'tag_id' => $tagName->id
        //     ]);
        //     // dd($request);
        //     $newTags = TagQuestion::create($request->toArray());
        //     $newTags->save();
        //     // dd($newTags);
        // }
        $this->increaseVotes();
        $this->updateBade();
        return redirect()->route('questions.index')->with('succuss', 'The Post Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {        
            //  dd($request->ip());
            $view = $question->id . Auth::id();
             $this->setCookie($view, $question);
        //   return $this->view;
                $question= $question->load([
                    'answers.user',
                    'user',
                    'tags'
                ]);
                // return $this->getNumberOfView($question->id);
                // dd($numOfView);
                return view('questions/index', [
                    'question' => $question,
                ]);
    //    $question_info = $question->with()
    //     $user = User::join('questions','users.id' , '=', 'questions.user_id')
    //     ->select([
    //         'users.name as userName',
    //         'users.votes as userVotes'
    //     ]) 
    //     ->where('questions.id' , '=' , $id)
    //     ->first();
    //     $answers = Question::join('answers','questions.id' , '=', 'answers.question_id')
    //     ->join('users','users.id', '=', 'answers.user_id')
    //     ->select([
    //         'answers.body as answersBody',
    //         'answers.votes as answerVotes',
    //         'users.name as userName',
    //         'users.votes as userVotes'
    //     ]) 
    //     ->where('questions.id' , '=' , $id)
    //     ->get();

    //     $question = Question::where('id', '=', $id)->limit(1)->first();
    //     if(!$user){
    //       abort(404) ; 
    //     }
    //     // $tags = Tag::pluck('name');

    //     return view('questions/index', [
    //         'question' => $question,
    //         'user' => $user,
    //         'answers' => $answers,
    //         // 'tags' => $tags
    // ]);
          
    }
    public function getNumberOfView($id)
    {
        $numOfView = 0;
                $len = strlen($id);
                $views = $this->getCookie();
                foreach($views as $item){
                    $str= substr($item, 0, $len);
                    if($str == $id){
                        $numOfView = $numOfView + 1;
                    }
                   
                }
        return $numOfView;
    }
    public function setCookie($view, $question)
    {
        if(Auth::check()){
            $views = [];
            $views = $this->getCookie();
            if(!in_array($view, $views)){
                $views [] = $view;
     
                Cookie::queue($this->name, serialize($views) , 30*24*60);
                $question_view = $question->view;
                $question_view  =$question_view + 1;
                $question->update([
                    'view' => $question_view
                ]);
                // \dd($question->view);
            }
        }
        
    //    $this->view = $views;
    }
    public function getCookie()
    {
        $views = Cookie::get($this->name);
        if($views){
            return $this->view = unserialize($views);
        }
        return [];
    }
    public function tagged($name)
    {
        $tag = Tag::where('slug', '=' , $name )->first();
        // dd($tag);
            if($tag){
                $questions = $tag->load([
                    'questions.tags',
                    'questions.user'
                ]);
            }else{
                $questions = new Tag();
            }
        
        // ->paginate(5);
        // return $questions->name;
        return view('tags.index', [
            'questions' => $questions,
            'tag_name' => $tag->name ?? ''
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //
    }
    // search about Tags or Question
    public function search(Request $request)
    {
        // dd($request->ip());
            // dd($name);
            $name = strtolower($request->post('name'));
            
            // dd($name);
            // $tagsQuestions = Tag::whereRaw('lower(name) like (?)',["%{$name}%"])->with(['questions.answers'])->get();
            $tag = Tag::where('name', '=' , $name )->first();

        if($tag){
            $tagsQuestions = $tag->load([
                'questions.tags',
                'questions.user'
            ]);
        }else{
            $tagsQuestions = new Tag();
        }
        $views = [];
            $questions = Question::whereRaw('lower(title) like (?)',["%{$name}%"])->paginate();
            if($questions){
                foreach($questions as  $question){
                    $views[] = $this->getNumberOfView($question->id);
                }
            }
            return view('index' ,[
                'views' => $views,
                'name' => $name,
                'questions' => $questions,
                'tagsQuestions' => $tagsQuestions
            ]);
        
    }
    public function increaseVotes()
    {
        $user1 = Auth::user();
        $vote1= User::where('id',$user1->id)->first();
        $vote1 = $vote1->votes;
        $vote1 =$vote1 +1;
        
        DB::table('users')->where('id', $user1->id)->update(['votes' => $vote1]);
    }
    public function updateBade()
    {   
        $user = Auth::user();
        // dd($user->votes);
        if($user->votes == 10){
         
            Achieve::Create([
                    'user_id' => Auth::id(),
                    'badge_id' => 3
                ]);
            }elseif($user->votes == 7){
           
                Achieve::Create([
                        'user_id' => Auth::id(),
                        'badge_id' => 2
                    ]);
        }elseif($user->votes == 2){
    
            Achieve::Create([
                    'user_id' => Auth::id(),
                    'badge_id' => 1
                ]);
        }
        // dd('dddddddd');
    }
}
