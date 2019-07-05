<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ログイン中のみ処理を実行する
Route::group(['middleware' => ['auth']], function () {
   // api関連の処理をまとめる（urlに自動的に/apiが加わる）
  Route::group(['middleware' => ['api']], function(){
      
      Route::post('/checkIn', 'WaricanApiController@checkIn');
      
  });
});
