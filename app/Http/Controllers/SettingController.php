<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Notification;
use App\Http\Controllers\MyFunc\MyFunc;

class SettingController extends Controller
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

    public function index(){
        return view('settings.home');
    }
    public function moreNotifications(Request $request){
        $notifications = auth()->user()->notifications()
        ->with('useraction')
        ->skip($request->offset)->take(10)
        ->get();

        Notification::whereIn('id',array_column($notifications->toArray(),'id'))->update(['viewed'=>0]);

        $notifications->map(function($data){
            /**
             * these i make just for Jquery but i will also use in blade like in Jquery
             */
            $data->cree_at = MyFunc::timeDifferent($data->created_at);
            $data->action_value = MyFunc::history($data);
            return $data;
        });
        return response()->json($notifications);
    }
    public static function notificationCount(){
        return auth()->user()->notifications()->where('viewed',1)->count();
    }
    public function notification(){
        $notificationSet = auth()->user()->notifications();
        $notificationCount = $notificationSet->count();
        $notificationSet->update(['viewed'=>0]);
        $notifications = auth()->user()->notifications()
        // $notificationsCount = $notifications;
        // $notifications->update(['viewed'=>0]);
        // $notifications->refresh();
        ->take(10)
        ->get();

        
        $notifications->map(function($data){
            $data->cree_at = MyFunc::timeDifferent($data->created_at);
            $data->action_value = MyFunc::history($data);
            return $data;
        });
        
        // return response()->json($notifications);
        return view('settings.notification',['notifications'=>$notifications,'notificationCount'=>$notificationCount]);
    }

    public function request(){
        $user = auth()->user();
        $followingNotAcceptedByOthers = $user->following()->whereNotIn('follow_id',$user->followed()->pluck('user_id'))->with('userFollowing')->get();
        $followedNotAcceptedByMe = $user->followed()->whereNotIn('user_id',$user->following()->pluck('follow_id'))->with('userFollowed')->get();
        // return response()->json(['followingNotAcceptedByOthers'=>$followingNotAcceptedByOthers,'followedNotAcceptedByMe'=>$followedNotAcceptedByMe]);
        return view('settings.request',['followingNotAcceptedByOthers'=>$followingNotAcceptedByOthers,'followedNotAcceptedByMe'=>$followedNotAcceptedByMe]);
    }
}
