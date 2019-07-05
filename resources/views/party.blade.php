@extends('layouts.app')
@section('content')
    <main id="index mr30">
        <div class="container mb-2">
            <div class="loginline">
                <div class="nimimakebox-registaer">
                    <div class="py-1">{{ $party->name }}</div>
                    <div class="py-1">開催日：{{ $party->date }}</div>
                    <div class="py-1">開始時間：{{ $party->time }}</div>
                    <div class="py-1">お店の情報：{{ $party->url }}</div>
                    <div class="pb-3">コメント：{{ $party->detail }}</div>
                
                    <!--幹事だけに表示する画面-->
                    <div class="pb-3">
                        <input id="copyTarget" class="urlcopy" type="textarea" value="https://75dadab680c248839d271828d1603090.vfs.cloud9.ap-northeast-1.amazonaws.com/join/?_key={{$party->_key}}" readonly>
                        <button onclick="copyToClipboard()">URLをコピー</button>
                    </div>
                    <script>
                        function copyToClipboard() {
                            // コピー対象をJavaScript上で変数として定義する
                            var copyTarget = document.getElementById("copyTarget");
                            // コピー対象のテキストを選択する
                            copyTarget.select();
                            // 選択しているテキストをクリップボードにコピーする
                            document.execCommand("Copy");
                            // コピーをお知らせする
                            alert("クリップボードにコピーしました！");
                        }
                    </script>
                    @if ($kanji[0]->user_id == Auth::user()->id)
                    <div class="text-center py-1">
                        <div class="flex-kanji">
                            <div class="pr-3">
                                <form action="{{ url ('/partyEdit/'.$party->id) }}" method="POST">
                                {{ csrf_field() }}
                                    <button type="submit" value="編集" class="btn-gradient-radius-registaer3">
                                         {{ __('編集') }}
                                    </button>
                                </form>
                            </div>
                            <div class="pl-3">
                                <form action="{{ url ('/partyDelete/'.$party->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" value="中止" class="btn-gradient-radius-registaer4">
                                        {{ __('中止') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> 
                    @endif
                    <!--幹事だけに表示する画面(ここまで)-->
            
                    <!--幹事だけに表示する画面-->
                    @if ($kanji[0]->user_id == Auth::user()->id && $party->start_time == '')
                    <div class="py-4">
                        <form action="{{ url ('/partyStart/'.$party->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="register">
                                <button type="submit" value="乾杯！" class="btn-gradient-radius-registaer5">
                                    {{ __('乾杯！') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                
                    @if ($kanji[0]->user_id == Auth::user()->id && $party->start_time != '' && $party->end_time == '')
                    <div class="py-4">
                        <form action="{{ url ('/partyEnd/'.$party->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="register">
                                <button type="submit" value="お会計" class="btn-gradient-radius-registaer5">
                                    {{ __('お会計') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                
                    @if ($kanji[0]->user_id == Auth::user()->id && $party->end_time != '' && $party->partyPrice == '')
                    <div class="my-4 text-center">
                        <form action="{{ url ('/calculate') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="totalPrice" class="urlcopy p-1" placeholder="お会計を入力して下さい">
                            <div class="register pt-4">
                                <button type="submit" value="計算する" class="btn-gradient-radius-registaer5">
                                    {{ __('割りCan!!') }}
                                </button>
                            </div>
                            <input type="hidden" name="id" value="{{ $party->id }}">
                        </form>
                    </div>
                    @endif
                
                    @if ($kanji[0]->user_id == Auth::user()->id && $party->partyPrice != '')
                    <div class="py-4">
                        <form action="{{ url ('/partyDelete/'.$party->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="register">
                                <button type="submit" value="Finish!" class="btn-gradient-radius-registaer5">
                                    {{ __('Finish!') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <!--幹事だけに表示する画面(ここまで)-->
                </div>
            </div>
        <!--</div>-->


            <!--参加者リスト(ここから)-->
             <!--<div class="container">-->
                <div class="text-center py-3 nomi-main">参加者リスト</div>
                    <div class="mb-3">
                         @foreach ($party_users as $party_user)
                        <div class="loginline text-center mb-3">
                            <div class="nimimakebox-registaer3 ">
                                <div class="flex-kanji">
                                <div class="pt-2">
                                    <p>{{ $party_user->user_name }}さん
                                          @if ($party_user->kanji_flag == 1)
                                        （幹事）
                                         @endif
                                    </p>
                                </div>    
                                 <div>         
                                     @if ($party_user->drink_flag == 0)
                                    <img src="/image/drinkbeer.png" class="img33 pb-4"></img>
                                    @else
                                    <img src="/image/nodrinkbeer.png" class="img33 pb-4"></img>
                                     @endif
                                </div> 
                            </div>
                                    <!--幹事だけに表示する画面-->
                                    @if ($kanji[0]->user_id == Auth::user()->id && $party_user->checkInTime == '' && $party_user->price == '')
                                     <form action="{{ url ('/checkIn/'.$party_user->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="register">
                                            <button type="submit" value="チェックイン" class="btn-gradient-radius-registaer2 mb-3">
                                                 {{ __('チェックイン') }}
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                    <!--幹事だけに表示する画面(ここまで)-->
                            <div class="flex-kanji">
                                <div class="pr-2">   
                                    @if ($party_user->price != '')
                                    <p class="font-p">{{ $party_user->price }}円</p>
                                     @endif
                                </div> 
                                <div class="font-p pl-2">   
                                    <!--幹事だけに表示する画面-->
                                    @if ($kanji[0]->user_id == Auth::user()->id && $party_user->price != '')
                                        <input type="checkbox">支払い確認
                                    @endif
                                </div> 
                            </div>
                                    <!--幹事だけに表示する画面(ここまで)-->
                        </div>
                    </div>
                    @endforeach
                </div>
            <!--</div>-->
        </div>
        <div class="space"></div>
    </main>
@endsection