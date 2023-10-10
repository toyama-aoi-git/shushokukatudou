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
<h2>仮登録</h2>
    <div>
        <form action="entry.php" method="POST">
        <p>氏名：<input type="text" name="name" value="<?php echo isset($_SESSION['name'])?  $_SESSION['name']: "";
        ?>"><?php echo $error_msg_name;?></p>
        <p>ログインID：<input type="text" name="login_id" value="<?php echo isset($_SESSION['login'])? $_SESSION['login']: "";
        ?>"><?php echo $error_msg_id;?></p>
        <p>パスワード：<input type="text" name="pass" value=""><?php echo $error_msg_pass;?></p>
        <p><?php echo $pass_again;?></p>
        <p>メールアドレス：<input type="mail" name="mail" value="<?php echo isset($_SESSION['mail'])? $_SESSION['mail']: "";
        ?>"><?php echo $error_msg_mail;?></p>
        <button type="submit" name="register">確認</button>
    </div>
</form>
</body>
</html>