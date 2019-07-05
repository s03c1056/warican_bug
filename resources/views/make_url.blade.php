@extends('layouts.app')
@section('content')
    <div class="nomi-infourl">
        <div class="nomi-infourl-box loginline">
            <p class="mleft">飲み会企画を作成しました！<br>
            URLをコピーして参加見込み者にシェアしてください。</p>
    
            <input id="copyTarget" type="textarea" class="urlcopy" value="https://75dadab680c248839d271828d1603090.vfs.cloud9.ap-northeast-1.amazonaws.com/join/?_key={{$randomString}}" readonly>
            <button onclick="copyToClipboard()">URLをコピー</button>
        </div>
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
@endsection