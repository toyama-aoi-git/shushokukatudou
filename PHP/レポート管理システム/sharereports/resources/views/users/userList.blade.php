<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aoi Toyama">
    <title>ユーザリスト</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <header>
        <h1>ユーザリスト</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li>ユーザリスト</li>
        </ul>
    </nav>
    @if(session("flashMsg"))
    <section id="flashMsg">
        <p>{{session("flashMsg")}}</p>
    </section>
    @endif

    <section>
        <p>
            新規ユーザ登録は<a href="/users/goUserAdd">こちら</a>から
        </p>
    </section>
    <section>
        <table>
            <thead>
                <tr>
                    <th>メールアドレス</th>
                    <th>名前</th>
                    <th>権限</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userList as $userId => $user)
                <tr>
                    <td>{{$user->getUsMail()}}</td>
                    <td>{{$user->getUsName()}}</td>
                    <!-- 追加 -->
                    <td>{{$user->getUsAuth()}}</td>
                    <td>
                        <a href="/users/prepareUserEdit/{{$userId}}">編集</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">該当ユーザは存在しません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ページャ -->
        {{ $userList->links() }}
    </section>
</body>

</html>