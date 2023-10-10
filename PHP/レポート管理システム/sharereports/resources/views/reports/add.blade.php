<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>レポート登録</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>レポート登録</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p><a href="/reports/showList">レポートリスト画面へ戻る</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li>レポート登録</li>
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
            情報を入力し、登録ボタンをクリックしてください。
        </p>
        <form action="/reports/add" method="post" class="box">
            @csrf
            <label for="addReportDate">
                作業日&nbsp;<span class="required">必須</span>
                <input type="date" id="addReportDate" name="addReportDate" value="{{$report->getRpDate()}}" required>
            </label><br>
            <label for="addReportTimeFrom">
                作業開始時刻&nbsp;<span class="required">必須</span>
                <input type="time" id="addReportTimeFrom" name="addReportTimeFrom" value="{{$report->getrpTimeFrom()}}" required>
            </label><br>
            <label for="addReportTimeTo">
                作業終了時刻&nbsp;<span class="required">必須</span>
                <input type="time" id="addReportTimeTo" name="addReportTimeTo" value="{{$report->getrpTimeTo()}}" required>
            </label><br>
            <label for="addReportcateId">
                作業種類&nbsp;<span class="required">必須</span>
                <select name="addReportcateId" id="addReportcateId" required>
                    <option value="">選択してください</option>
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
            <label for="addReportContent">
                作業内容&nbsp;<span class="required">必須</span>
                <textarea id="addReportContent" name="addReportContent" required>{{$report->getRpContent()}}</textarea>
            </label>
            <button type="submit">登録</button>
        </form>
    </section>
</body>

</html>