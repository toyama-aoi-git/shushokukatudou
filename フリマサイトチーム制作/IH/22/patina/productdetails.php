<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";

if(!isset($_GET['id'])){
    header("location:index.php");
}
else{
    $sql = "SELECT id , name , img_url , price , sentence
        FROM m_product
        WHERE id = ". $_GET['id'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
}


/////////////////////////////// 購入手続きへが押されたとき
if(isset($_GET['pur'])){
    header("location:purchase.php?id=". $_GET['pur'] ."");
}

require_once "./view/header.php";
require_once "./view/productDetails.php";
require_once "./view/footer.php";
?>