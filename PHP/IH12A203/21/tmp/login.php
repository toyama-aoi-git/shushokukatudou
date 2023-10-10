<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
<h1>PH24評価課題</h1>
<h2>ログイン</h2>
    <div>
        <p><?php echo $error;?></p>
        <form action="login.php" method="post">
        <p>ログインID：<input type="text" name="id" value="<?php echo isset($_POST['id'])? $_POST['id'] : "";?>"></p>
        <p>パスワード：<input type="text" name="pass"></p>
        <button type="submit" name="login">ログイン</button>
<p><a href="./entry.php">会員登録はこちら</a></p>

    </div>
</form>
</body>
</html>