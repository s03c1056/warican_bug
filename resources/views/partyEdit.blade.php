@extends('layouts.app')
@section('content')
    <main id="index">
        <div class="container mb-5">
            <div class="loginline">
                <div class="nimimakebox-registaer">
                    <form action="{{ url ('party/update')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">企画名</label>
                            <input type="text" class="nomitypebox1" id="name" name="name" placeholder="企画名入力" value="{{ $party->name }}">
                        </div>
                        <div class="form-group">
                            <label for="date">日付</label>
                            <input type="date" class="nomitypebox1" id="date" name="date" value="{{ $party->date }}">
                        </div>
                        <div class="form-group">
                            <label for="time">開始時間</label>
                            <input type="time" class="nomitypebox1" id="time" name="time" value="{{ $party->time }}">
                        </div>
                        <div class="form-group">
                            <label for="detail">飲み会詳細</label>
                            <textarea class="nomitypebox1" id="detail" name="detail" rows="3" placeholder="飲み会詳細入力">{{ $party->detail }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">お店情報URL</label>
                            <input type="url" class="nomitypebox1" id="url" name="url" placeholder="お店のURL入力"  value="{{ $party->url }}">
                        </div>
                        <input type="hidden" class="nomitypebox1" id="url" name="id" placeholder="お店のURL入力"  value="{{ $party->id }}">
                        <div class="register">
                            <button type="submit" value="登録" class="btn-gradient-radius-registaer1">
                                {{ __('再登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection