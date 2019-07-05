<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Party;
use App\PartyUser;
use Auth;

class CalculateController extends Controller {
    
    public function calculate (Request $request) {
        
    //飲み会の情報を収得
        $party = Party::where('id', $request->id)
                                ->get();
           
           
        //初期データ//
        //お酒を飲んだ人数
        $drankParson = PartyUser::join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->where('drink_flag', 0)
                                ->count();
           
        //お酒を飲んでない人数
        $noDrankParson = PartyUser::join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->where('drink_flag', 1)
                                ->count();
           
           
        //飲み会の時間                    
        $startTime = $party[0]->start_time;
        $endTime = $party[0]->end_time;
        $partyTime = $endTime - $startTime;       
           
        //飲み会の合計金額
        $totalPrice = $request->totalPrice;
           
        $borderTime = 1800;      //最初の30分(時間考慮をしない時間)
           
           
        //パーティ参加者を抽出
        $partyUsers = PartyUser::select('party_users.id as party_users_id', 'drink_flag', 'checkInTime')
                                ->join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->get();
           
                                
           
        //飲み会開始30分以内にチェックインした人をカウント
        $inTimeParson = 0;       //開始30分以内にいる人
        foreach ($partyUsers as $partyUser) {
            $checkInTime = $partyUser->checkInTime;
            if ($checkInTime - $startTime <= 1800) {
                $inTimeParson += 1;
            }
        }
                                
           
        $priceSum = 0;           //金額調整用の変数
        $handicapSum = 0;        //金額調整用の変数
        $handicapTime = $partyTime - $borderTime;     //飲み会の遅刻者割適用時間を算出
           
        $drankAdjustedPrice = 0;        //調整した一人当たりの金額(お酒を飲んだ人)
        $noDrankAdjustedPrice = 0;      //調整した一人当たりの金額(お酒を飲んでない人)
        $adjustedPrice = 0;             //調整した一人当たりの金額(全員飲んでるor全員飲んでない)
        $change = 0;                    //おつり
           
        //基本金額(考慮無しで均等に割った場合)
        $people = $drankParson + $noDrankParson;
        $basicPrice = $totalPrice / $people;
           
        //飲む人飲まない人が混在しているか片方しかいないかで条件分岐
        if ($noDrankParson > 0 && $drankParson > 0) {
           
            //お酒を飲む人と飲まない人どっちが多いかで条件分岐
            if ($drankParson >= $noDrankParson) {
           
                //お酒を飲んだ人が多い場合、飲んでない人の金額を1割減にして調整する
                $noDrankAdjustedPrice = $basicPrice * 0.9;
                $drankPeopleTotal = $totalPrice - ($noDrankAdjustedPrice * $noDrankParson);
                $drankAdjustedPrice = $drankPeopleTotal / $drankParson;
               
              
           
                //一旦データベースに格納
                foreach ($partyUsers as $partyUser) {
                    
                    if ($partyUser->drink_flag == 0) {
                       
                        $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                        $dbpartyUsers->price = $drankAdjustedPrice;
                        $dbpartyUsers->save();
                        
                        echo $dbpartyUsers->drink_flag;
                        echo "<br>";
                        echo $dbpartyUsers->user_name;
                        echo "<br>";
                        echo $dbpartyUsers->price;
                        echo "<br>";
                        echo "-----------------------------------";
                        echo "<br>";
                       
                    } else {
                       
                        $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                        $dbpartyUsers->price = $noDrankAdjustedPrice;
                        $dbpartyUsers->save();
                        
                        echo $dbpartyUsers->drink_flag;
                        echo "<br>";
                        echo $dbpartyUsers->user_name;
                        echo "<br>";
                        echo $dbpartyUsers->price;
                        echo "<br>";
                        echo "-----------------------------------";
                        echo "<br>";
        
                    }
                }
           
            } else {
           
                //お酒を飲んでない人が多い場合、飲んだ人の金額を1割増にして調整する
                $drankAdjustedPrice = $basicPrice * 1.1;
                $noDrankPeopleTotal = $totalPrice - ($drankAdjustedPrice * $drankParson);
                $noDrankAdjustedPrice = $noDrankPeopleTotal / $noDrankParson;
           
                //一旦データベースに格納
                foreach ($partyUsers as $partyUser) {
                    
                    if ($partyUser->drink_flag == 0) {
                       
                        $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                        $dbpartyUsers->price = $drankAdjustedPrice;
                        $dbpartyUsers->save();
                       
                    } else {
                       
                        $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                        $dbpartyUsers->price = $noDrankAdjustedPrice;
                        $dbpartyUsers->save();
                       
                    }
                }
             }
        } else {
           
            //飲む人だけ飲まない人だけの場合は基本金額を一旦データベースに格納
            foreach ($partyUsers as $partyUser) {
                       
                $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                $dbpartyUsers->price = $basicPrice;
                $dbpartyUsers->save();
        
            }
        }
        
        // exit();
        //ここからは時間考慮///////////////////////////////////////////////////////////////////////
           
        //再度パーティ参加者を抽出
        $partyUsers = PartyUser::select('party_users.id as party_users_id', 'drink_flag', 'checkInTime','price')
                                ->join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->get();
        
        //一人ずつタイムハンデをデータベースに格納
        foreach ($partyUsers as $partyUser) {
           
            //飲み会開始30分以内に来た人は100％
            if ($borderTime >= $partyUser->checkInTime - $startTime) {
                
                $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                $dbpartyUsers->handicap = 1;
                $dbpartyUsers->save();
                 
                $handicapSum += 1;
                $priceSum += $partyUser->price;
                
                echo $dbpartyUsers->user_name;
                echo "<br>";
                echo $dbpartyUsers->price;
                echo "<br>";
                echo $priceSum;
                echo "<br>";
                echo "-----------------------------------";
                echo "<br>";
           
            } else {
           
                $lateParsonPartyTime = $partyTime - $partyUser->checkInTime;
                $handicap = $lateParsonPartyTime / $handicapTime;
                $handicapSum += $handicap;
               
                $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                $dbpartyUsers->price = $partyUser->price * $handicap;
                $dbpartyUsers->handicap = $handicap;
                $dbpartyUsers->save();
                 
                $priceSum += $partyUser->price * $handicap;
                
                echo $dbpartyUsers->user_name;
                echo "<br>";
                echo $dbpartyUsers->price;
                echo "<br>";
                echo $priceSum;
                echo "<br>";
                echo "-----------------------------------";
                echo "<br>";
                
            }
        }
        
        // exit();
           
        $difference = $totalPrice - $priceSum;
        
        echo $totalPrice;
        echo "<br>";
        echo $priceSum;
        echo "<br>";
        echo "-----------------------------------";
        echo "<br>";
        
        $adjustedTotalPrice = 0;
           
        //再度パーティ参加者を抽出
        $partyUsers = PartyUser::select('party_users.id as party_users_id', 'drink_flag', 'checkInTime', 'price', 'handicap')
                                ->join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->get();
           
        foreach ($partyUsers as $partyUser) {
            $n = $partyUser->handicap / ($handicapSum);
            $partyUser->price += $difference * $n;
             
            $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
            $dbpartyUsers->price = round($partyUser->price, -2);
            $dbpartyUsers->save();
             
            $adjustedTotalPrice += round($partyUser->price, -2);
            
            echo $n;
            echo "<br>";
            echo $difference;
            echo "<br>";
            echo "-----------------------------------";
            echo "<br>";
        }
           
        // exit();
           
        $partyUsers = PartyUser::select('party_users.id as party_users_id', 'drink_flag', 'checkInTime', 'price', 'handicap')
                                ->join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->get();
                                
        //最終調整
        if ($adjustedTotalPrice < $totalPrice) {
              
            $adjustedTotalPrice = 0;
              
            foreach ($partyUsers as $partyUser) {
                 
                $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                $dbpartyUsers->price += 100;
                $dbpartyUsers->save();
                 
                $adjustedTotalPrice += $partyUser->price + 100;
                 
            }
        }
           
        if (($adjustedTotalPrice - $totalPrice) > ($people * 100)) {
              
            $adjustedTotalPrice = 0;
              
            foreach ($partyUsers as $partyUser) {
                 
                $dbpartyUsers = PartyUser::find($partyUser->party_users_id);
                $dbpartyUsers->price -= 100;
                $dbpartyUsers->save();
           
                $adjustedTotalPrice += $partyUser->price - 100;
            }
        }
           
        $partyUsers = PartyUser::select('party_users.id as party_users_id', 'drink_flag', 'checkInTime', 'price', 'handicap')
                                ->join('parties', 'party_id', '=', 'parties.id')
                                ->where('parties.id', $request->id)
                                ->where('attend_flag', 0)
                                ->get();
        
        $dbparty = Party::find($request->id);
        $dbparty->partyPrice = $totalPrice;
        $dbparty->totalPrice = $adjustedTotalPrice;
        $dbparty->change = $adjustedTotalPrice - $totalPrice;
        $dbparty->save();
        
        return back();
    }
}
