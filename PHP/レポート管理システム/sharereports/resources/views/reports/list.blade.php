<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>レポートリスト</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>レポートリスト</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li>レポートリスト</li>
        </ul>
    </nav>
    @if(session("flashMsg"))
    <section id="flashMsg">
        <p>{{session("flashMsg")}}</p>
    </section>
    @endif

    <!-- 管理者にはユーザリストに飛べるようにした -->
    @if(session("auth") == 1)
    <section>
        <p>
            ユーザリストは<a href="/users/showUserList">こちら</a>から
        </p>
    </section>
    @endif
    <section>
        <p>
            新規登録は<a href="/reports/goAdd">こちら</a>から
        </p>
    </section>
    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>作業日</th>
                    <th>作業内容</th>
                    <th>報告者名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reportList as $reportId => $report)
                <tr>
                    <td>{{$report->getId()}}</td>
                    <td>{{$report->getRpDate()}}</td>
                    <td>{!! nl2br($report->getRpContent()) !!}</td>
                    <!-- 追加 -->
                    <td>{{$report->getUserName()}}</td>
                    <td>
                        <a href="/reports/showDetail/{{$reportId}}">詳細</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">該当レポートは存在しません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ページャ -->
        {{ $reportList->links() }}
    </section>
</body>

</html>