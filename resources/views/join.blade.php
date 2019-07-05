@extends('layouts.app')
@section('content')
    <div class="nomi-infourl-box">
        <div class="atend-loginline">{{$find[0]->name}}</div>
        <div class="atend-loginline">企画者:{{$find[0]->user_name}}さん</div>
        <div class="atend-loginline">予定日:{{$find[0]->date}}</div>
        <div class="atend-loginline">開始時間:{{$find[0]->time}}</div>
        
        <div class="join-btn2">
            <button type="" class="join-btn" id="joincome">参加する</button>
    
            <form action="{{ url ('/join/add')}}" method="POST">
            {{ csrf_field() }}
                <button type="submit" class="join-btn">参加しない</button>
                <input type="hidden" name="attend_flag" value="1"/>
                <input type="hidden" name="drink_flag" value="1"/>
                <input type="hidden" name="party_id" value="{{$find[0]->id}}"/>
            </form>
        </div>
    </div>
       
    <div class="hide-box">
        <!--<div class="join-btn2">-->
               
        <p class="atend-loginline2">お酒は飲みますか？</p>
        <div class="join-btn3">
            <form action="{{ url ('/join/add')}}" method="POST">
            {{ csrf_field() }}
            <div class="a1a">
             <img src="/image/drinkbeer.png" alt="" class="a2a">
                <button type="submit" class="join-btn">飲む</button>
                <input type="hidden" name="attend_flag" value="0"/>
                <input type="hidden" name="drink_flag" value="0"/>
                <input type="hidden" name="party_id" value="{{$find[0]->id}}"/>
                </div>
            </form>
            
           
            <form action="{{ url ('/join/add')}}" method="POST">
            {{ csrf_field() }}
             <div class="a1a">
                  <img src="/image/nodrinkbeer.png" alt="" class="a2a">
                <button type="submit" class="join-btn">飲まない</button>
                <input type="hidden" name="attend_flag" value="0"/>
                <input type="hidden" name="drink_flag" value="1"/>
                <input type="hidden" name="party_id" value="{{$find[0]->id}}"/>
                </div>
            </form>
            
        </div>

    </div>
    
    <script >
        $(function () {
            $('#joincome').click(function () {
                $('.hide-box').show();
            });
        });
    </script>
@endsection