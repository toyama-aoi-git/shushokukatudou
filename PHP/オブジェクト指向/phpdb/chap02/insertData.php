<?php
/**
 * PH35 サンプル2 PHP DB Access Src05/14
 * Chap2-1 データ登録。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=insertData.php
 * フォルダ=/ph35/phpdb/chap02/
 */

 $dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
 $username = "ph35sqlusr";
 $password = "hogehoge";
 try{
    $db = new PDO($dsn, $username, $password);

    $orderDate = date("Y-m-d H:i:s");

    /**
     * sql文の文末セミコロンは不要
     * ※PHPのコードを書く前にsql文がちゃんと動くものか確認する。確認出来たらコピペする。
     * ※sqlで実行できるものはsqlで処理する。(SQLから逃げるな！)
     * 
     * 「:○○」はプレースホルダーと言い、後から値を変えれるようにする。
     * ※バインド時文字列に「'」を付けるので、この段階では付ける必要がない。
     */
    $sql = "INSERT INTO orders (order_id, order_date, order_mode, customer_id,order_status, order_total, sales_rep_id, promotion_id) VALUES (:order_id, :order_date,:order_mode, :customer_id, :order_status, :order_total, :sales_rep_id, :promotion_id)";

    /**
     * PDOStatementオブジェクトを取得する。
     * →$stmt:PDOStatement , $db:PDO
     */
    $stmt = $db->prepare($sql);

    /**
     * 変数のバインドを行う
     * →sql文内の変動する値を、変数＆文字連結で処理するのではなく変数のバインドで行う(前者はSQLインジェクションの原因になりえる)。
     * →上で記述したsql文のプレースホルダーに値を埋め込む。
     * →bindValue(プレースホルダー名,埋め込む値や変数,カラムのデータ型に応じた引数)
     */
    $stmt->bindValue(":order_id", 8000, PDO::PARAM_INT);
    $stmt->bindValue(":order_date", $orderDate, PDO::PARAM_STR);
    $stmt->bindValue(":order_mode", "web", PDO::PARAM_STR);
    $stmt->bindValue(":customer_id", 101, PDO::PARAM_INT);
    $stmt->bindValue(":order_status", 0, PDO::PARAM_INT);
    $stmt->bindValue(":order_total", 1500.23, PDO::PARAM_INT);
    $stmt->bindValue(":sales_rep_id", null, PDO::PARAM_NULL);
    $stmt->bindValue(":promotion_id", null, PDO::PARAM_NULL);

    /**
     * PDOstatementに対して実行する(戻り値はtrueかException,falseはほとんどない)。
     */
    $result = $stmt->execute();
 }
 catch(PDOException $ex) {
    print("DB接続に失敗しました。<br>");
    var_dump($ex);
 }
 finally{
    $db = null;
 }
 //$result = true;
 if($result){
    $msg = "SQL文の実行が成功しました。";
 }
 else{
    $msg = "SQL文の実行が失敗しました。";
 }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Shinzo SAITO">
        <title>PH35 サンプル2 | PHP DB Access | Ch2-1 データ登録</title>
    </head>
    <body>
        <h1>PHP DB Access: Chap2-1 データ登録</h1>
        <p>
            結果: <?= $msg ?>
        </p>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>