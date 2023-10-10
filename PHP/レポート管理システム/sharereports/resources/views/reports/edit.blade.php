<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>レポート編集</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>レポート編集</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p><a href="/reports/showDetail/{{$report->getId()}}">レポート詳細画面へ戻る</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li><a href="/reports/showDetail/{{$report->getId()}}">レポート詳細</a></li>
            <li>レポート編集</li>
        </ul>
    </nav>
    @isset($validationMsgs)
    <section id="errorMsg">
        <p>以下のメッセージをご確認ください。</p>
        <ul>
            @foreach($validationMsgs as $msg)
            <li>{{$msg}}</li>
            @endforeach
        </ul>
    </section>
    @endisset
    <section>
        <p>
            情報を入力し、更新ボタンをクリックしてください。
        </p>
        <form action="/reports/edit" method="post" class="box">
            @csrf
            レポートID:&nbsp;{{$report->getId()}}<br>
            <input type="hidden" name="editReportId" value="{{$report->getId()}}">
            <label for="editReportDate">
                作業日&nbsp;<span class="required">必須</span>
                <input type="date" id="editReportDate" name="editReportDate" value="{{$report->getRpDate()}}" required>
            </label><br>
            <label for="editReportTimeFrom">
                作業開始時刻&nbsp;<span class="required">必須</span>
                <input type="time" id="editReportTimeFrom" name="editReportTimeFrom" value="{{$report->getrpTimeFrom()}}" required>
            </label><br>
            <label for="editReportTimeTo">
                作業終了時刻&nbsp;<span class="required">必須</span>
                <input type="time" id="editReportTimeTo" name="editReportTimeTo" value="{{$report->getrpTimeTo()}}" required>
            </label><br>
            <label for="editReportcateId">
                作業種類&nbsp;<span class="required">必須</span>
                <select name="editReportcateId" id="editReportcateId" required>
                    @foreach($reportcateList as $list)
                    <!-- selectedを付ける場合 -->
                    @if($report->getReportcateId() == $list->getId())
                    <!-- valueに主キーを指定している -->
                    <option value="{{$list->getId()}}" selected>
                        {{$list->getRcName()}}
                    </option>
                    @else
                    <option value="{{$list->getId()}}">
                        {{$list->getRcName()}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </label><br>
            <label for="editReportContent">
                作業内容&nbsp;<span class="required">必須</span>
                <textarea id="editReportContent" name="editReportContent" required>{{$report->getRpContent()}}</textarea>
            </label>
            <button type="submit">更新</button>
        </form>
    </section>
</body>

</html>