<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Party;
use App\PartyUser;
use App\Login;
use Auth;


class JoinController extends Controller {
    
    public function join (Request $request) {
        if(Auth::check()){
            $key = $request->input('_key');
            $find = PartyUser::join('parties', 'party_id', '=', 'parties.id')//DBからデートを持ってきて
                                ->where("_key", $key)//キーの一致かつ幹事のみ抽出。
                                ->where('kanji_flag', 1)
                                ->get(); 
            $user = \Auth::user();
            $chk = PartyUser::join('parties', 'party_id', '=', 'parties.id')
                                ->where('_key', $key)
                                ->where('user_id', $user->id)
                                ->get();


             if($chk == '[]'){                
                        return view ('/join',compact('find','user'));
            }else{
                $parties = PartyUser::join('parties', 'party_id', '=', 'parties.id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
                return view('partyList', ['parties' => $parties]);    
            }
       
        }else{
            $key = $request->input('_key');
            $lolipop = url()->current();
            //$url = "http://75dadab680c248839d271828d1603090.vfs.cloud9.ap-northeast-1.amazonaws.com/join/?_key={$key}";
            $url = $lolipop."/join/?_key={$key}";
        session(['url' => $url, 'key' => $key]);
        // var_dump($all);
        // exit();
        return view('/auth/login');
        }
    }
}
