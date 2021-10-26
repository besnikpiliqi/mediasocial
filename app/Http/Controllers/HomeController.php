<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Post;
use App\Models\LikePost;
use App\Models\LikeComment;
use App\Models\Comment;
use App\Models\Follower;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MyFunc\MyFunc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function show(Post $post)
    // {
    //    $posts = $post->has('user')->with('user:id,name,email,picture')->findOrFail($post->id);

    //     return view('your_blade_file_path',compact('posts));
    // }
    // Post::with(['user' => function ($query) {
    //     $query->select('id','company_id', 'username');
    // }, 'user.company' => function ($query) {
    //     $query->select('id', 'name');
    // }])->get();
    public function index()
    {
        // $questions = Post::orderBy("created_at", 'desc')->skip(0)->take(3)->get();
        $user = auth()->user();
        $posts = tap(Post::whereIn('user_id',$user->following()->pluck('follow_id'))
                ->with('user')
                ->with('likes')
                ->withCount('comments')
                ->withCount('likes')
                ->orwhereIn('user_id',[$user->id])
                ->orderBy('created_at','desc')
                ->paginate(5))->map(function($data,$index){
                    $data->cree_at = MyFunc::timeDifferent($data->created_at);
                    return $data;
               });
        // $post = Post::select(DB::raw('count(*)'))->whereColumn('user_id', 'users.id');
        //        $users = User::select([
        //         'users.*',
        //         'last_posted_at' => $post
        //     ])->get();
        
        // return response()->json(["posts" => $users]);
        
        return view('home', ["posts" => $posts]);
    }
    public function prov(Request $request){
        $searche = preg_replace("/[^A-Za-z0-9 ]/", '', $request->get('searche'));
        if(!strlen($searche)){
            return response()->json();
        }
        $searche = explode(' ',$searche);
        $searched = User::whereLikeWith(['name','username', 'posts.content'], $request->get('searche') )
        ->with('posts')
        // ->with(['posts' => function($post) use ($request){
        //     $post->where('content','LIKE' ,"%{$request->get('searche')}%");
        // }])
        ->get()->map(function($user){
            $user->photoProfile = '/storage/'.$user->photo;
            return $user;
        });
        return response()->json($searched);
    }
    public function searcheUser(Request $request){
        $searche = preg_replace("/[^A-Za-z0-9 ]/", '', $request->get('searche'));
        if(!strlen($searche)){
            return response()->json();
        }
        $searche = explode(' ',$searche);
        $searched = User::whereLikeName(['name'], array_values($searche) )->get();
        return response()->json($searched);
    }
    

    public function checkVotePost($post_id){
        $postVoted = LikePost::where(['user_id'=>auth()->id(),'post_id'=>$post_id])->first();
        return response()->json($postVoted);
    }

    public function votePost(Request $request){
        $arr = ['user_id'=>auth()->id(),'post_id'=>$request->get('post_id')];
        $votePost = LikePost::updateOrCreate($arr,['stars'=>$request->get('vote')]);
        /**
         * History create or update it will be on the observer LikePostObserver.php
         */
        return response()->json($votePost);
    }

    public function checkVoteComment($comment_id){
        $postVoted = LikeComment::where(['user_id'=>auth()->id(),'comment_id'=>$comment_id])->first();
        return response()->json($postVoted);
    }
    public function voteComment(Request $request){
        $comment = Comment::find($request->get('comment_id'))->first();
        $arr = [ 'user_id'=>auth()->id(), 'post_id'=>$comment->post_id, 'comment_id'=>$request->get('comment_id')];
        $votePost = LikeComment::updateOrCreate($arr,['stars'=>$request->get('vote')]);
        /**
         * History create or update it will be on the observer LikeCommentObserver.php
         */
        return response()->json($votePost);
    }
    public function newPost(Request $request){
        $validate = Validator::make($request->all(),
        ['content' => ['required', 'max:255'],'file' => 'mimes:jpeg,jpg,png',],
        ['content.required'=>"C'est obligé",
        'content.max'=>"Le contenu est au maximum 255 lettre",
        'file.mimes'=>"La photo doit etre en format JPEG,JPG,PNG"]);

        if($validate->fails()){
            return response()->json(['error'=>$validate->messages()]);
        }
        $post = new Post();
        if($request->hasFile('file')){
            $post->photo = '/storage/'.$request->file('file')->store('posts/', ['disk' => 'public']);
        }
        $post->user_id = auth()->id();
        $post->content = $request->content;
        return response()->json(['success'=>$post->save()]);
    }
    public function editPost(Request $request,Post $post){
        if (!Gate::allows('update-post', $post)) {
            return response()->json(['success'=>0]);
        }
        $validate = Validator::make(
            $request->all(),
            [
                'content' => ['required', 'max:255'],
                'file' => 'mimes:jpeg,jpg,png'
            ],
            [
                'content.required'=>"C'est obligé",
                'content.max'=>"Le contenu est au maximum 255 lettre",
                'file.mimes'=>"La photo doit etre en format JPEG,JPG,PNG"]
        );

        if($validate->fails()){
            return response()->json(['error'=>$validate->messages()]);
        }
        if($request->hasFile('file')){
            $path = public_path().$post->photo;
            File::delete($path);
            $post->photo = '/storage/'.$request->file('file')->store('posts/', ['disk' => 'public']);
        }
        $post->content = $request->content;
       return response()->json(['success'=>$post->save()]);
        
        
    }
    public function deletePost(Post $post){
        if (!Gate::allows('delete-post', $post)) {
            return response()->json(['success'=>0]);
        }
        elseif($post->delete()){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }
    }

    public function deleteComent(Comment $comment){
       
        if (!Gate::allows('delete-comment', $comment)) {
            return response()->json(['success'=>0]);
        }
        elseif($comment->delete()){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }
        
    }

    public function getComments(Request $request){
        // $comments = Comment::where('post_id',$request->get('post_id'))
        //         ->with('user')
        //         ->with('likes')
        //         ->withCount('likes')
        //         ->orderBy('created_at','desc')
        //         ->get()->map(function($data,$index){
        //             $data->cree_at = MyFunc::timeDifferent($data->created_at);
        //             return $data;
        //        });
        $comments = Post::where('id',$request->get('post_id'))
        ->with('comments')
        ->with('comments.user')
        ->with('comments.likes')
        ->with(['comments' => function($comment){
            $comment->withCount('likes');
        }])
        ->get()->map(function($data){
            $data->comments->map(function($comment){
                $is_voted = false;
                $comment->cree_at = MyFunc::timeDifferent($comment->created_at);
                if(count($comment->likes)){
                    foreach($comment->likes as $likes){
                        if($likes->user_id == auth()->id()){
                            $is_voted = true;
                        }
                    }
                }
                $comment->is_commented = $comment->user_id == auth()->id();
                $comment->avg_votes = (int) MyFunc::avg($comment->likes);
                $comment->is_voted = $is_voted;
            });
            
            return $data;
       });
      

        return response()->json($comments);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
