<?php
/**
 * PH35 サンプル2 PHP DB Access Src04/14
 * Chap1-3 DB接続失敗と例外処理。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=failedToConnectWithTryCatch.php
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
        <title>PH35 サンプル2 | PHP DB Access | Ch1-3 DB接続失敗と例外処理</title>
    </head>
    <body>
        <h1>PHP DB Access: Chap1-3 DB接続失敗と例外処理</h1>
        <?php
            /**
             * 例外処理用の構文「try catch finally構文」
             */

            //例外が起こりそうなコードを入れる
            try {
                $db = new PDO($dsn, $username, $password);
        ?>
            <p>DBに接続しました。</p>
        <?php
            //例外が起こったとき処理されるコードを書く
            //PDOExceptonが発生したとき用の例外処理を書いている。(他の例外処理を書く場合は、新しいcatchブロックを作っておく)
            }catch(PDOException $ex){
        ?>
            <p>DB接続に失敗しました。</p>
            <ul>
                <!-- 例外コードを取得 -->
                <li>Code: <?= $ex->getCode() ?></li>

                <!-- 例外が発生したファイルを取得 -->
                <li>File: <?= $ex->getFile() ?></li>

                <!-- 例外が発生した行を取得 -->
                <li>Line: <?= $ex->getLine() ?></li>
                <li>
                    Message:<br>
                    <!-- 例外メッセージを取得 -->
                    <?= $ex->getMessage() ?>
                </li>
                <li>
                    Trace:<br>
                    <!-- 例外が発生するまでの経緯(スタックトレース)を取得 -->
                    <?= $ex->getTraceAsString() ?>
                </li>
            </ul>
        <?php
            }
            //例外の有無に関係なく行う処理を書く
            finally{
                // めっちゃ重要！！
                $db = null;
        ?>
            <p>DB接続を切断しました。</p>
        <?php
            }
        ?>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>