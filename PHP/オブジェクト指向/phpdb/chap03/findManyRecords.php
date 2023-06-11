<?php
/**
 * PH35 サンプル2 PHP DB Access Src08/14
 * Chap3-1 複数行のデータ取得。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=findManyRecords.php
 * フォルダ=/ph35/phpdb/chap03/
 */

 $dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
 $username = "ph35sqlusr";
 $password = "hogehoge";
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Shinzo SAITO">
        <title>PH35 サンプル2 | PHP DB Access | Ch3-1 複数行のデータ取得</title>
        <style type="text/css">
            table{
                border-collapse: collapse;
            }
            th,td{
                border: solid 1px black;
            }
        </style>
    </head>
    <body>
        <h1>PHP DB Access: Chap3-1 複数行のデータ取得</h1>
        <table>
            <thead>
                <tr>
                    <th>注文ID</th>
                    <th>注文日時</th>
                    <th>注文種類</th>
                    <th>顧客ID</th>
                    <th>注文状況</th>
                    <th>注文合計</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try{
                        $db = new PDO($dsn, $username, $password);

                        $sql = "SELECT * FROM orders WHERE order_mode = :order_mode";
                        $stmt = $db->prepare($sql);
                        $stmt->bindValue(":order_mode", "online", PDO::PARAM_STR);
                        $result = $stmt->execute();

                        /**
                         * SQL文を実行したら、$stmtには結果表が丸々格納される。
                         * →表から1行分の配列を取得するのがfetch
                         * →それを配列の行数分ループさせたら、全実行結果を取得できる。
                         */
                        while($row = $stmt->fetch()) {
                            $orderId = $row["order_id"];
                            $orderDate = $row["order_date"];
                            $orderMode = $row["order_mode"];
                            $customerId = $row["customer_id"];
                            $orderStatus = $row["order_status"];
                            $orderTotal = $row["order_total"];
                ?>
                            <tr>
                                <!-- ＜？＝$a？＞は＜？php　echo $a;?>と同じ意味 -->
                                <td><?= $orderId ?></td>
                                <td><?= $orderDate ?></td>
                                <td><?= $orderMode ?></td>
                                <td><?= $customerId ?></td>
                                <td><?= $orderStatus ?></td>
                                <td><?= $orderTotal ?></td>
                            </tr>
                <?php
                        }
                    }
                    catch(PDOException $ex){
                        print("DB接続に失敗しました。<br>");
                        var_dump($ex);
                    }
                    finally{
                        $db = null;
                    }
                ?>
            </tbody>
        </table>
        <p>
            <a href="/ph35/phpdb/index.html">戻る</a>
        </p>
    </body>
</html>