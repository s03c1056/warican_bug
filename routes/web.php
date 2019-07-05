<?php

use App\Party;
use App\PartyUser;
use Illuminate\Http\Request;
use App\Login;


//トップ画面表示
Route::get('/', 'WaricanController@top');

//飲み会企画ページ表示
Route::get('/plan', 'WaricanController@planning');

//飲み会企画登録処理
Route::post('/plan/store', 'WaricanController@store');

//参加見込み者出欠確認ページ表示
Route::get('/join', 'JoinController@join');

//参加見込み者出欠情報登録処理
Route::post('/join/add', 'WaricanController@attend');

//参加予定飲み会一覧ページ表示
Route::get('/parties', 'WaricanController@partyIndex');

//飲み会詳細ページ表示
Route::get('/party/{party}', 'WaricanController@partyDetail');

//飲み会情報削除処理
Route::post('/partyDelete/{party}', 'WaricanController@delete');

//飲み会情報を編集
Route::post('/partyEdit/{party}', 'WaricanController@partyEdit');

//飲み会情報更新
Route::post('/party/update', 'WaricanController@partyUpdate');

//参加者チェックイン時間登録処理
Route::post('/checkIn/{partyUser}', 'WaricanController@checkIn');

//飲み会開始時間登録処理
Route::post('/partyStart/{party}', 'WaricanController@partyStart');

//飲み会終了時間登録処理
Route::post('/partyEnd/{party}', 'WaricanController@partyEnd');

//会計計算処理
Route::post('/calculate', 'CalculateController@calculate');




Auth::routes();
Route::get('/home', 'WaricanController@top')->name('home');
