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
    <h2>本登録</h2>
    <div>
    <p>氏名：<?php echo $list[0]['name']; ?></p>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <p>パスワード：<input type="text" name="pass"><?php echo $error_pass;?></p>
        <p>画像：<input type="file" name="img"><?php echo $error_img;?></p>
        <input type="hidden" name="login_id" value="<?php echo $register_id;?>">
        <br><button name="btn" value="register">登録</button>
</form>
</div>
</body>
</html>