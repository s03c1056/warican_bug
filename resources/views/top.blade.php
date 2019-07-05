@extends('layouts.app')
@section('content')
    <main id="index">
        <!--<header>-->
            <!--<h1 class="home">Home</h1>-->
        <!--</header>-->
    
        <div id="menubox" class="pi7">
            <div class="b1 pi7">
                <div class="btn7 btn1 pi7">
                    <a href="{{ url ('plan')}}">
                        <h2>飲み会を企画</h2>
                    </a>
                </div>
    
                <div class="btn7 btn2 pi7">
                    <a href="{{ url ('parties')}}">
                        <h2>飲み会参加予定</h2>
                    </a>
                </div>
            </div>
    
            <div class="b2 pi7">
                <div class="btn7 btn3 pi7">
                    <a href="{{ url ('plan')}}">
                        <h2>割り勘計算</h2>
                    </a>
                </div>
    
                <div class="btn7 btn4 pi7">
                    <a href="{{ url ('plan')}}">
                        <h2>外食家計簿</h2>
                    </a>
                </div>
            </div>
    
            <div class="b3 pi7">
                <div class="btn7 btn5 pi7">
                    <a href="https://tabelog.com/">
                        <h2>お店を探す</h2>
                    </a>
                </div>
    
                <div class="btn7 btn6 pi7">
                    <a href="{{ url ('plan')}}">
                        <h2>飲み会参加履歴</h2>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection