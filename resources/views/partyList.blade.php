@extends('layouts.app')
@section('content')
    @if (count($parties) > 0)
    <div class="text-center my-4 nomi-main">飲み会リスト</div>
        <div class="mb-5">
             @foreach ($parties as $party)
                <main id="index">
                    <div class="container mb-2">
                        <div class="loginline">
                            <div class="nimimakebox-registaer">
                                <a href="{{ url ('party/'.$party->id)}}">
                                    <div class="pl1">
                                        <div class="py-1">{{ $party->name }}</div>
                                        <div class="py-1">{{ $party->date }}</div>
                                        @if ($party->kanji_flag == 1)
                                            <div class="py-1">あなたが幹事です</div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            @endforeach
        </div>
    @endif
@endsection