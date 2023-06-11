<?php

/**
 * PH35 Lesson 6 DAO
 * トランザクションサンプルコード。
 * 
 * @author Shinzo SAITO
 */

$dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
$username = "ph35sqlusr";
$password = "hogehoge";

$msg = "";
try {
    $db = new PDO($dsn, $username, $password);

    $inputCustomerId = 1001;
    $inputCustFirstName = "Shinzo";
    $inputCustLastName = "SAITO";
    $inputOrderId = 9000;
    $orderDate = date("Y-m-d H:i:s");
    $inputOrderMode = "web";
    $inputOrderStatus = 0;
    $inputOrderTotal = 1500.23;


    $sqlInsertCustomer = "INSERT INTO customers (customer_id, cust_first_name, cust_last_name) VALUES (:customer_id, :cust_first_name, :cust_last_name)";
    $sqlInsertOrder = "INSERT INTO orders (order_id, order_date, order_mode, customer_id, order_status, order_total, sales_rep_id, promotion_id) VALUES (:order_id, :order_date, :order_mode, :customer_id, :order_status, :order_total, :sales_rep_id, :promotion_id)";

    $db->beginTransaction();

    $stmt = $db->prepare($sqlInsertCustomer);
    $stmt->bindValue(":customer_id", $inputCustomerId, PDO::PARAM_INT);
    $stmt->bindValue(":cust_first_name", $inputCustFirstName, PDO::PARAM_STR);
    $stmt->bindValue(":cust_last_name", $inputCustLastName, PDO::PARAM_STR);
    $result = $stmt->execute();
    if ($result) {
        $msg .= "IDが" . $inputCustomerId . "の顧客情報の登録が完了しました。<br>";
    } else {
        throw new Exception("IDが" . $inputCustomerId . "の顧客情報登録に失敗したので、処理を中止します。");
    }

    $stmt = $db->prepare($sqlInsertOrder);
    $stmt->bindValue(":order_id", $inputOrderId, PDO::PARAM_INT);
    $stmt->bindValue(":order_date", $orderDate, PDO::PARAM_STR);
    $stmt->bindValue(":order_mode", $inputOrderMode, PDO::PARAM_STR);
    $stmt->bindValue(":customer_id", $inputCustomerId, PDO::PARAM_INT);
    $stmt->bindValue(":order_status", $inputOrderStatus, PDO::PARAM_INT);
    $stmt->bindValue(":order_total", $inputOrderTotal, PDO::PARAM_INT);
    $stmt->bindValue(":sales_rep_id", null, PDO::PARAM_NULL);
    $stmt->bindValue(":promotion_id", null, PDO::PARAM_NULL);
    $result = $stmt->execute();
    if ($result) {
        $msg .= "IDが" . $inputOrderId . "の注文情報の登録が完了しました。<br>";
    } else {
        throw new Exception("IDが" . $inputOrderId . "の注文情報登録に失敗したので、処理を中止します。");
    }

    $msg .= "全てのSQL文の実行が成功しました。<br>";
    $db->commit();
} catch (PDOException $ex) {
    $db->rollBack();
    var_dump($ex);
    $msg .= "<br>" . $ex->getMessage() . "<br>DB処理に失敗しました。ロールバックします。<br>";
} catch (Exception $ex) {
    $db->rollBack();
    var_dump($ex);
    $msg .= $ex->getMessage();
    $msg .= "<br>" . $ex->getMessage() . "<br>DB処理に失敗しました。ロールバックします。<br>";
} finally {
    $db = null;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>PH35 Lesson 6 トランザクションサンプル</title>
</head>

<body>
    <h1>PH35 Lesson 6 トランザクションサンプル</h1>
    <p><?= $msg ?></p>
</body>

</html>