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
        <h1>仮登録が完了しました</h1>
        <p>登録はまだ完了していません</p>
        <p>ご登録いただいたメールアドレス宛に本登録用のメールを送信しました。</p>
        <p>下記URLから本登録を行ってください</p>
        <p><a href="<?php echo BASE_URL ;?>21/register.php?id=<?php echo $_SESSION['hash'];?>">本登録URL</a></p>
    </div>
</form>
</body>
</html>