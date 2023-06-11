<?php

/**
 * PH35 サンプル5 マスタテーブル管理DAO版 Src02/13
 * エラー画面
 *
 * @author Shinzo SAITO
 *
 * ファイル名=error.php
 * フォルダ=/scottadmindao/public/
 */
$errorMsg = "もう一度始めから操作をお願いします。";
if (isset($_SESSION["errorMsg"])) {
    $errorMsg = $_SESSION["errorMsg"];
}
unset($_SESSION["errorMsg"]);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>Error | ScottAdminDAO Sample</title>
</head>

<body>
    <h1>Error</h1>
    <section>
        <h2>申し訳ございません。障害が発生しました。</h2>
        <p>
    </section>
    <p><a href="/">TOPへ戻る</a></p>
</body>

</html>