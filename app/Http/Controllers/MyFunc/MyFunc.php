<?php

namespace App\Http\Controllers\MyFunc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use Carbon\Carbon;

class MyFunc extends Controller
{
    public static function avg($stars){
        $count = 0;
        foreach($stars as $star){
            $count = $count + $star->stars;
        }
        $count = ($count ? number_format($count/count($stars)) : 0);
        return $count;
    }

    public static function following($follows){
        
        foreach($follows->followed as $follow){
            if($follow->user_id == auth()->id()){
                return true;
            };
        }
        return false;
    }

    public static function followed($follows){
        
        foreach($follows->following as $follow){
            if($follow->follow_id == auth()->id()){
                return true;
            };
        }
        return false;
    }

    public static function voted($likes){
        
        foreach($likes as $like){
            if($like->user_id == auth()->id()){
                return true;
            };
        }
        return false;
    }

    public static function timeDifferent($date){
        $trouve = array("T", ".000000Z");
        $remplace   = array(" ", "");
        $dateFormated = str_replace($trouve, $remplace, $date);// this i make laravel transformé dans ce format "2021-10-06T14:25:58.000000Z" donc le T et .000000Z ne compté pas comme il faut surtout les heures

        $diff = Carbon::now('Europe/Paris')->diff($date);
        if($diff->y > 0){
            return 'Il y a '.$diff->y.($diff->y == 1 ? ' an' : ' ans');
        }elseif($diff->m > 0){
            return 'Il y a '.$diff->m.($diff->m == 1 ? ' mois' : ' mois');
        }elseif($diff->days > 0){
            return 'Il y a '.$diff->days.($diff->days == 1 ? ' jour' : ' jours');
        }elseif($diff->h > 0){
            return 'Il y a '.$diff->h.' heure';
        }elseif($diff->i > 0){
            return 'Il y a '.$diff->i.($diff->i == 1 ? ' minute' : ' minutes');
        }else{
            return 'Il y a '.$diff->s.($diff->s == 1 ? ' seconde' : ' secondes');
        }
        
    }

    public static function country(){
        return Country::with('citys')->get();
    }
}
