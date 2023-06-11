<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
session_start();

if(isset($_GET['flag'])){


    $sql_sale = "UPDATE m_product
                 SET sale = 1
                 WHERE id = ". $_GET['flag'] ."";
    insert(HOST, USER_ID, PASSWORD, DB_NAME, $sql_sale);

    $sql = "INSERT INTO m_purchase(product_id , customer_id , postage , decide_day , credit_id)
            VALUES (". $_GET['flag'] ." , ". $_COOKIE['id'] ." , 500 , ". date('Ymd') ." , 1)";
    insert(HOST, USER_ID, PASSWORD, DB_NAME, $sql);

    $_SESSION["insert"] = "完了";
    header("location:purchase_com.php");
    exit;

}


if(!isset($_GET['id'])){
    header("location:index.php");
}
else{
    $sql = "SELECT id , name , img_url , price , sentence
        FROM m_product
        WHERE id = ". $_GET['id'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
}


require_once './view/header.php';
require_once './view/purchase.php';
require_once './view/footer.php';

?>