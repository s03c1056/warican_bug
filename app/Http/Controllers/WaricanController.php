<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Party;
use App\PartyUser;
use Auth;
use Session;

class WaricanController extends Controller {
    
    
    
    //ログインチェック処理
    public function __construct () {
        
        $this->middleware('auth');
    }
    
    
    
    //トップページ表示
    public function top () {
        $key = session()->pull('key');
        $lolipop = url()->current();///実験
        //$chk = "http://75dadab680c248839d271828d1603090.vfs.cloud9.ap-northeast-1.amazonaws.com/join/?_key=".$key;
        $chk = $lolipop.$key;////実験
        
        if (session()->has('url')) { 
            $url = session()->pull('url');
            if ($url == $chk) {
                return redirect()->away($url);
            } else {
                return view('top');
            }
        } else {
            return view('top');
        }
    }    
    
    //飲み会企画ページ表示
    public function planning () {
        
        return view('plan');
    }
    
    
    
    //飲み会企画登録処理
    public function store (Request $request) {
        
        $randomString = str_random(30);
        
        //飲み会の情報を登録
        $party = new Party;
        $party->name = $request->name;
        $party->date = $request->date;
        $party->time = $request->time;
        $party->detail = $request->detail;
        $party->url = $request->url;
        $party->_key = $randomString;
        $party->save();
       
        //今登録した飲み会企画レコードを抽出
        $kanji = Party::where('name', $request->name)
                        ->where('date', $request->date)->get();

        //飲み会メンバーに幹事の情報を登録
        $partyUser = new PartyUser;
        $partyUser->party_id = $kanji[0]->id;
        $partyUser->user_id = Auth::user()->id;
        $partyUser->user_name = Auth::user()->name;
        $partyUser->kanji_flag = 1;
        $partyUser->attend_flag = 0;
        $partyUser->drink_flag = $request->drink_flag;
        $partyUser->save();
       
        return view('make_url',compact('randomString'));
    }
    
    
    
    //参加見込み者の出欠確認
    public function attend (Request $request) {
        //飲み会参加見込者の情報を登録
        $partyUser = new PartyUser;
        $partyUser->party_id = $request->party_id;
        $partyUser->user_id = Auth::user()->id;
        $partyUser->user_name = Auth::user()->name;
        $partyUser->kanji_flag = 0;
        $partyUser->attend_flag = $request->attend_flag;
        $partyUser->drink_flag = $request->drink_flag;
        $partyUser->save();
   
        return redirect('/parties');
    }
    
    
    
    //参加予定の飲み会一覧表示
    public function partyIndex () {
        $parties = PartyUser::join('parties', 'party_id', '=', 'parties.id')
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('date', 'asc')
                            ->get();

        return view('partyList', ['parties' => $parties]);
    }
    
    
    
    //飲み会詳細ページ表示
    public function partyDetail (Party $party) {
        $party_users = PartyUser::where('party_id', $party->id)->get();
        $kanji = PartyUser::where('party_id', $party->id)
                            ->where('kanji_flag', 1)->get();
        $myId = Auth::user()->id;
   
        return view('party', ['party' => $party,
                                'party_users' => $party_users,
                                'kanji' => $kanji,
                                'myId' => $myId]);
    }
    
    
    
    //飲み会情報削除処理
    public function delete (Party $party) {
        $party_users = PartyUser::where('party_id', $party->id)->delete();
        $party->delete();
        return redirect('/');
    }
    
    
    
    //飲み会情報を編集
    public function partyEdit (Party $party) {
        return view('partyEdit', ['party' => $party]);
    }
    
    
    
    //飲み会情報更新
    public function partyUpdate (Request $request) {
        $party = Party::find($request->id);
        $party->name = $request->name;
        $party->date = $request->date;
        $party->time = $request->time;
        $party->detail = $request->detail;
        $party->url = $request->url;
        $party->save();
        return redirect('/parties');
    }
    
    
    
    //参加者チェックイン時間登録処理
    public function checkIn (PartyUser $partyUser) {
        $partyUser = PartyUser::find($partyUser->id);
        $partyUser->checkInTime = time();
        $partyUser->save();
        return back();
    }
    
    
    
    //飲み会開始時間登録処理
    public function partyStart (Party $party) {
        $party = Party::find($party->id);
        $party->start_time = time();
        $party->save();
        return back();
    }
    
    
    
    //飲み会終了時間登録処理
    public function partyEnd (Party $party) {
        $party = Party::find($party->id);
        $party->end_time = time();
        $party->save();
        return back();
    }
}

