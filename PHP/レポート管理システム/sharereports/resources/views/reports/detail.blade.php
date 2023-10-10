<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>レポート詳細</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>レポート詳細</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p><a href="/reports/showList">レポートリスト画面へ戻る</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li>レポート詳細</li>
        </ul>
    </nav>
    @if(session("flashMsg"))
    <section id="flashMsg">
        <p>{{session("flashMsg")}}</p>
    </section>
    @endif
    <section>
    </section>
    <section>

        <dl>
            <dt>レポートID</dt>
            <dd>{{$report->getId()}}</dd><br>
            <dt>報告者名</dt>
            <dd>{{$user->getUsName()}}</dd><br>
            <dt>メールアドレス</dt>
            <dd>{{$user->getUsMail()}}</dd><br>
            <dt>作業日</dt>
            <dd>{{$report->getRpDate()}}</dd><br>
            <dt>作業開始時間</dt>
            <dd>{{$report->getrpTimeFrom()}}</dd><br>
            <dt>作業終了時間</dt>
            <dd>{{$report->getrpTimeTo()}}</dd><br>
            <dt>作業種類名</dt>
            <dd>{{$reportcate->getRcName()}}</dd><br>
            <dt>作業内容</dt>
            <dd>{!! nl2br($report->getRpContent()) !!}</dd><br>
            <dt>レポート登録日時</dt>
            <dd>{{$report->getRpCreatedAt()}}</dd><br>
            <dt>操作</dt>
            <dd>
                <a href="/reports/prepareEdit/{{$report->getId()}}">編集</a>
                <a href="/reports/confirmDelete/{{$report->getId()}}">削除</a>
            </dd>
        </dl>

    </section>
</body>

</html>