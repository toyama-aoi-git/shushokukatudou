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
<div>
    <p>氏名：<?php echo $_SESSION['name'];?></p>
    <p>ログインID:<?php echo $_SESSION['login'];?></p>
    <p>パスワード：*******</p>
    <p>メールアドレス：<?php echo $_SESSION['mail'];?></p>
        
    <section><form action="confirmation.php" method="POST">
        <button type="submit" name="back">戻る</button>
    </form>    
    
        <form action="confirmation.php" method="POST">
        <button type="submit" name="register">登録</button>
    </div>
</form>
</section>
</body>
</html>