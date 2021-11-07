<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Country;
use App\Models\City;
use App\Models\History;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MyFunc\MyFunc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index($username = null)
    {
        
        if(!$username){
            $user = auth()->user(); 
        }else{
            $user = User::where('username', '=', $username)->firstOrFail();
        }
        
        $profile = $user->withCount('following')
                        ->withCount('followed')
                        ->with('following')
                        ->with('followed')
                        ->with('city')
                        ->with('city.country')
                        ->withCount('posts')
                        ->withAvg('haveLikedPost','stars')
                        ->withAvg('likesPost','stars')
                        ->withAvg('haveLikedComment','stars')
                        ->withAvg('likesComment','stars')
                        ->withCount('haveLikedPost')
                        ->withCount('likesPost')
                        ->withCount('haveLikedComment')
                        ->withCount('likesComment')
                        ->where('id',$user->id)
                        ->first();
        $posts = tap($user->posts()
        ->withCount('comments')
        ->with('likes')
        ->withCount('likes')
        ->paginate(5))->map(function($data){
             $data->cree_at = MyFunc::timeDifferent($data->created_at);
             return $data;
        });
        // return response()->json(['profile' => $profile,'posts' => $posts]);
        return view('profile', ["profile" => $profile, "posts" => $posts]);
    }
    public function checkTheComportemnt(Request $request){
        $user = User::where('id',$request->user_id)
                    ->withAvg('haveLikedComment','stars')
                    ->withAvg('haveLikedPost','stars')
                    ->get();
        return response()->json($user);
    }
    public function comportementUser(Request $request){
        $stars = [['stars'=>0,'star'=>1],['stars'=>0,'star'=>2],['stars'=>0,'star'=>3],['stars'=>0,'star'=>4],['stars'=>0,'star'=>5] ];

        if($request->action == 'Des votes dans ses commentaires'){
            $action = 'haveLikedComment';
        }elseif($request->action == 'Des votes dans ses publicatioons'){
            $action = 'haveLikedPost';
        }elseif($request->action == 'Ses votes dans des commentaires'){
            $action = 'likesComment';
        }elseif($request->action == 'Ses votes dans des publications'){
            $action = 'likesPost';
        }else{
            return response()->json(false);
        }
        $user = User::find($request->user_id)->$action()->get();
        foreach ($user as $value) {
            $stars[$value->stars - 1]['stars']++;
        }
        return response()->json(['starsPost'=>array_reverse($stars)]);
    }
    public function edit()
    {
        $countrys = Country::with('citys')->get();
        $profile = auth()->user()
                        ->with('city')
                        ->with('city.country')
                        ->first();
        return view('edit-profile',['profile'=>$profile,'countrys' => $countrys]);
    }
    public function update(Request $request){
        $update = ['name'=>$request->name,'email'=>$request->email,'username'=>$request->username,'city_id'=>$request->city];
        $regles = ['name' => ['required', 'string', 'max:50'],
        'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.auth()->id().'id'],
        'username' => ['required', 'string', 'max:50', 'unique:users,username,'.auth()->id().'id'],
        'city' => ['exists:citys,id'],
        'file' => 'mimes:jpeg,jpg,png'
        ];
        $messages = ['name.required'=>"C'est obligé le nom",
        'name.string'=>"Le nom doit etre string",
        'name.max'=>"Le nom doit contenir au maximum 50 lettres",
        'email.required'=>"C'est obligé le mail",
        'email.email'=>"Doit etre un mail valide!",
        'email.unique'=>"Ce mail est déjà pris!",
        'username.required'=>"C'est obligé username!",
        'username.string'=>"Username doit etre que des lettres!",
        'username.unique'=>"Ce username est déjà pris!",
        'city.exists'=>"Cette ville n'existe pas!",
        'file.mimes'=>"La photo doit etre en format JPEG,JPG,PNG"
        ];
        if($request->hasFile('file')){
            if(auth()->user()->photo != 'profile/profilDefault.jpg'){
                // si la photo n'est pas par default alors on supprime la photo avant de mettre une nouvelle photo
                $path = public_path().auth()->user()->photo;
                File::delete($path);
            }
            $update['photo'] = '/storage/'.$request->file('file')->store('profile/', ['disk' => 'public']);
        }
        if($request->filled('password')){
            $regles['password'] = ['string', 'min:8', 'confirmed'];
            $messages['password.string'] = "Mot de passe doit etre un string!";
            $messages['password.min'] = "Mot de passe doit contenir au mois 8 lettres";
            $messages['password.confirmed'] = "Les mots de passes doivent etre identique!";
            $update['password'] = Hash::make($request->password);
        }
        $validate = Validator::make($request->all(),$regles,$messages);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        auth()->user()->update($update);
        return redirect()->back()->with('success','Vous avez modifié votre profile avec success!');
    }

    public function citys(Request $request){
        $citys = City::where('country_id',$request->get('id'))->get();
        return response()->json(['citys' => $citys]);
    }

    public function followed(Request $request){
        $follows = Follower::where('follow_id',$request->id)->with(['userFollowed'])->get();
        return response()->json($follows);
    }

    public function following(Request $request){
        $follows = Follower::where('user_id',$request->id)->with(['userFollowing'])->get();
        return response()->json($follows);
    }

    public function unfollow(Request $request){
        $follow_id = $request->get('follow_id');
        $follow = Follower::where(function ($query) use ($follow_id) {
            $query->where(['user_id' => $follow_id, 'follow_id' => auth()->id() ]);
        })
        ->orwhere(function ($query) use ($follow_id) {
            $query->where(['follow_id' => $follow_id, 'user_id' => auth()->id() ]);
        });

        if($follow->delete()){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    
    public function follow(Request $request){
        $follow = Follower::firstOrCreate(['user_id' => auth()->id(), 'follow_id' => $request->get('follow_id')]);
        if($follow){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
        /**
         * History create or update it will be on the observer FollowerObserver.php
         */
    }

    
}
