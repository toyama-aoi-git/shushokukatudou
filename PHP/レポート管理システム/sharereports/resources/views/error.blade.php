<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>Error</title>
</head>

<body>
    <p>{{session("name")}}がログイン中</p>
    <h1>Error</h1>
    <section>
        <h2>申し訳ございません。障害が発生しました。</h2>
        <p>
            以下のメッセージご確認ください。<br>
            {{$errorMsg}}
        </p>
    </section>
    <p><a href="/goTop">TOPへ戻る</a></p>
</body>

</html>