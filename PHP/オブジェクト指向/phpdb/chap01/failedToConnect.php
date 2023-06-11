<?php
/**
 * PH35 サンプル2 PHP DB Access Src03/14
 * Chap1-2 DB接続失敗。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=failedToConnect.php
 * フォルダ=/ph35/phpdb/chap01/
 */

 $dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
 $username = "ph35sqlusr";
 $password = "bowbow"; //わざと間違ったパスワードにしてみる。
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Shinzo SAITO">
        <title>PH35 サンプル2 | PHP DB Access | Ch1-2 DB接続失敗</title>
    </head>
    <body>
        <h1>PHP DB Access: Chap1-2 DB接続失敗</h1>
        <?php
            /**
             * ここでエラーが出る。実はエラーではなく例外！！（Exception）
             * →エラーは起こらないようにするもの。例外は起こったときに対処ができたらOK(対処不能なら発生させたらダメ)。
             * →オブジェクト指向言語では、「例外処理」を重視していく。
             */
            $db = new PDO($dsn, $username, $password);
        ?>

        <!-- これ以降のコードは一切処理されない -->
        <p>DBに接続しました。</p>
        <?php
            $db = null;
        ?>
        <p>DB接続を切断しました。</p>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>