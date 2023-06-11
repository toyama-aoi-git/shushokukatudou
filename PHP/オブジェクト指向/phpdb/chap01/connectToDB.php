<?php
/**
 * PH35 サンプル2 PHP DB Access Src02/14
 * Chap1-1 DB接続と切断。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=connectToDB.php
 * フォルダ=/ph35/phpdb/chap01/
 */

 //ファイルの先頭で変数を宣言しておく。（見やすい,書き換えやすい）

 //接続パラメータ
 $dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";

 $username = "ph35sqlusr";

 $password = "hogehoge";
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Shinzo SAITO">
        <title>PH35 サンプル2 | PHP DB Access | Ch1-1 DB接続と切断</title>
    </head>
    <body>
        <h1>PHP DB Access: Chap1-1 DB接続と切断</h1>
        <?php
            /**
             * mysqliではなくPDOに書き方を変える。
             * →mysqliだとMySQLでしか動かない関数になってしまう。(柔軟性の低さが問題)
             * →PDOクラスを使うことでDB接続の抽象化ができ、PDOに渡す接続パラメータを変更するだけでDBの変更に対応できる。(sql文の記法違いには対応していない)
             * 
             * PDOの流れ
             * 「接続」→「データ処理」→「切断」
             */

            //DBへの接続($dbがDBとの架け橋になる)
            $db = new PDO($dsn, $username, $password);
        ?>
        <p>DBに接続しました。</p>
        <?php
            //接続
            $db = null;
        ?>
        <p>DB接続を切断しました。</p>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>