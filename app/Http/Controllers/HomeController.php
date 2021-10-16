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
    public function index()
    {
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
        // return response()->json(['posts' => $posts]);
        return view('home', ["posts" => $posts]);
    }
    public function prov(){
        $prov = User::search(['name', 'email'],'le')->get();
        return response()->json($prov);
    }
    public function searcheUser(Request $request){
        $searche = preg_replace("/[^A-Za-z0-9 ]/", '', $request->get('searche'));
        $searche = explode(' ',$searche);
        // if(!strlen($searche)){
        //     return response()->json();
        // }
        $searched = Post::whereLikeWith(['comments.content','content'], $request->get('searche') )->get();
        return response()->json($searched);
    }
    

    public function checkVotePost($post_id){
        $postVoted = LikePost::where(['user_id'=>auth()->id(),'post_id'=>$post_id])->first();
        return response()->json($postVoted);
    }
    public function votePost(Request $request){
        $votePost = LikePost::where(['user_id'=>auth()->id(),'post_id'=>$request->get('post_id')])->first();
        if($votePost){
            $votePost->update(['stars'=>$request->get('vote')]);
        }else{
            $votePost = LikePost::create(['user_id'=>auth()->id(),'post_id'=>$request->get('post_id'),'stars'=>$request->get('vote')]);
        }
        return response()->json($votePost);
    }

    public function checkVoteComment($comment_id){
        $postVoted = LikeComment::where(['user_id'=>auth()->id(),'comment_id'=>$comment_id])->first();
        return response()->json($postVoted);
    }
    public function voteComment(Request $request){
        
        $votePost = LikeComment::where(['user_id'=>auth()->id(),'comment_id'=>$request->get('comment_id')])->first();
        if($votePost){
            $votePost->update(['stars'=>$request->get('vote')]);
        }else{
            $comment_post_id = Comment::find($request->get('comment_id'))->first()->post_id;
            $votePost = LikeComment::create([
                'user_id'=>auth()->id(),
                'post_id'=>$comment_post_id,
                'comment_id'=>$request->get('comment_id'),
                'stars'=>$request->get('vote')]);
        }
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
            $post->photo = $request->file('file')->store('posts/', ['disk' => 'public']);
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
            $path = public_path().'/storage/'.$post->photo;
            File::delete($path);
            $post->photo = $request->file('file')->store('posts/', ['disk' => 'public']);
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
        $comments = Comment::where('post_id',$request->get('post_id'))
                ->with('user')
                ->with('likes')
                ->withCount('likes')
                ->orderBy('created_at','desc')
                ->get()->map(function($data,$index){
                    $data->cree_at = MyFunc::timeDifferent($data->created_at);
                    return $data;
               });;
      

        return response()->json(['comments' => $comments]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
