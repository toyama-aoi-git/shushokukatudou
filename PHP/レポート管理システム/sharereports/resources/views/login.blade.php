<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>ログイン | ScottAdminMiddle Sample</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>ログイン</h1>
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
            IDとパスワードを入力し、ログインをクリックしてください。
        </p>
        <form action="/login" method="post">
            @csrf
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="email" id="mail" name="mail" value="{{$mail ?? ""}}" required>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" id="password" name="password" required>
                </dd>
            </dl>
            <button type="submit">ログイン</button>
        </form>
    </section>
</body>

</html>