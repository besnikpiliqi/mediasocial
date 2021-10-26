<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\History;
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
    public function moreHistory($offset){
        $historys = auth()->user()->historys()
        ->with('useraction')
        ->skip($offset)->take(10)
        ->get();

        History::whereIn('id',array_column($historys->toArray(),'id'))->update(['viewed'=>0]);

        $historys->map(function($data){
            /**
             * these i make just for Jquery but i will also use in blade like in Jquery
             */
            $data->cree_at = MyFunc::timeDifferent($data->created_at);
            $data->action_value = MyFunc::history($data);
            return $data;
        });
        return response()->json($historys);
    }
    public function history(){
        $historys = auth()->user()->historys()
        ->with('useraction')
        ->take(10)
        ->get();

        History::whereIn('id',array_column($historys->toArray(),'id'))->update(['viewed'=>0]);

        $historys->map(function($data){
            $data->cree_at = MyFunc::timeDifferent($data->created_at);
            $data->action_value = MyFunc::history($data);
            return $data;
        });
        
        // return response()->json($historys);
        return view('settings.history',['historys'=>$historys]);
    }
}
