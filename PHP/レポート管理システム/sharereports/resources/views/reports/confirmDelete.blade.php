<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>レポート情報削除</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>レポート情報削除</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p><a href="/reports/showDetail/{{$report->getId()}}">レポート詳細画面へ戻る</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li><a href="/reports/showDetail/{{$report->getId()}}">レポート詳細</a></li>
            <li>レポート情報削除確認</li>
        </ul>
    </nav>
    <section>
        <p>
            以下のレポート情報を削除します。<br>
            よろしければ、削除ボタンをクリックしてください。
        </p>
        <dl>
            <dt>作業日</dt>
            <dd>{{$report->getRpDate()}}</dd>
            <dt>作業内容</dt>
            <dd>{!! nl2br($report->getRpContent()) !!}</dd>
            <dt>報告者名</dt>
            <dd>{{$user->getUsName()}}</dd>
        </dl>
        <form action="/reports/delete" method="post">
            @csrf
            <input type="hidden" id="deleteReportId" name="deleteReportId" value="{{$report->getId()}}">
            <button type="submit">削除</button>
        </form>
    </section>
</body>

</html>