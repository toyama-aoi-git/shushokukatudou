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
        <h1>ユーザ編集</h1>
        <p><a href="/logout">ログアウト</a></p>
        <p><a href="/users/showUserList">ユーザリスト画面へ戻る</a></p>
        <p>{{session("name")}}がログイン中</p>
    </header>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/reports/showList">レポートリスト</a></li>
            <li><a href="/users/showUserList">ユーザリスト</a></li>
            <li>ユーザ編集</li>
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
        <form action="/users/userEdit" method="post" class="box">
            @csrf
            ユーザID:&nbsp;{{$user->getId()}}<br>
            <input type="hidden" name="editUserId" value="{{$user->getId()}}">

            <label for="editUserMail">
                メールアドレス&nbsp;<span class="required">必須</span>
                <input type="email" id="editUserMail" name="editUserMail" value="{{$user->getUsMail()}}" required>
            </label><br>
            <label for="editUserName">
                名前&nbsp;<span class="required">必須</span>
                <input type="text" id="editUserName" name="editUserName" value="{{$user->getUsName()}}" required>
            </label><br>
            <label for="editUserPassword">
                パスワード&nbsp;<span class="required">必須</span>
                <input type="password" id="editUserPassword" name="editUserPassword" value="" required>
            </label><br>
            <label for="editUsAuth">
                権限&nbsp;<span class="required">必須</span>
                <select name="editUsAuth" id="editUsAuth" required>
                    @for($i=0;$i<=2;$i++) <!-- selectedを付ける場合 -->
                        @if($i === $user->getUsAuth())
                        <!-- valueに主キーを指定している -->
                        <option value="{{$user->getUsAuth()}}" selected>
                            {{$user->getUsAuth()}}
                        </option>
                        @else
                        <option value="{{$i}}">
                            {{$i}}
                        </option>
                        @endif
                        @endfor
                </select>
            </label><br>
            <button type="submit">編集</button>
        </form>
    </section>
</body>

</html>