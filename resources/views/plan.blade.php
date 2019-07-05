@extends('layouts.app')
@section('content')
    <main id="index">
        <div class="container mb-5">
            <div class="loginline">
                <div class="nimimakebox-registaer">
                    <form action="{{ url ('plan/store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">企画名</label>
                            <input type="text" class="nomitypebox1" id="name" name="name" placeholder="企画名入力">
                        </div>
                        <div class="form-group">
                            <label for="date">日付</label>
                            <input type="date" class="nomitypebox1" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="time">開始時間</label>
                            <input type="time" class="nomitypebox1" id="time" name="time">
                        </div>
                        <div class="form-group">
                            <label for="detail">飲み会詳細</label>
                            <textarea class="nomitypebox1" id="detail" name="detail" rows="3" placeholder="飲み会詳細入力"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">お店情報URL</label>
                            <input type="url" class="nomitypebox1" id="url" name="url" placeholder="お店のURL入力">
                        </div>
                        <div class="form-group">
                            <p>あなたはお酒を飲みますか？</p>
                            <input type="radio" id="drink_flag" name="drink_flag" value="0"  min="0" max="1">
                            <label for="drink_flag">飲む</label>
                            <input type="radio" id="drink_flag1" name="drink_flag" value="1"  min="0" max="1">                        
                            <label for="drink_flag1">飲まない</label>
                        </div>
                    
                        <div class="register">
                            <button type="submit" value="登録" class="btn-gradient-radius-registaer1">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection