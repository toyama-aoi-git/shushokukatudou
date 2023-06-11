<?php
/**
 * PH35 サンプル2 PHP DB Access Src07/14
 * Chap2-3 データ削除。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=deleteData.php
 * フォルダ=/ph35/phpdb/chap02/
 */

 $dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
 $username = "ph35sqlusr";
 $password = "hogehoge";
 try{
    $db = new PDO($dsn, $username, $password);

    $sql = "DELETE FROM orders WHERE order_id = :order_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":order_id", 8000, PDO::PARAM_INT);
    $result = $stmt->execute();
 }
 catch(PDOException $ex) {
    print("DB接続に失敗しました。<br>");
    var_dump($ex);
 }
 finally {
    $db = null;
 }
 if($result) {
    $msg = "SQL文の実行が成功しました。";
 }
 else {
    $msg = "SQL文の実行が失敗しました。";
 }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Shinzo SAITO">
        <title>WP16 サンプル6 | PHP DB Access | Ch2-3 データ削除</title>
    </head>
    <body>
        <h1>PHP DB Access: Chap2-3 データ削除</h1>
        <p>
            結果: <?= $msg ?>
        </p>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>