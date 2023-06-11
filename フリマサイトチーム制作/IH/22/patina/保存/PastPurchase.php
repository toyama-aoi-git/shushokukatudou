<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
require_once "./view/header.php";

if(!isset($_GET["id"])){ // ページに入ってきた時
    header("location:index.php");
}
else{

    $sql = "SELECT pr.id , pr.name , pr.img_url , pr.price , pu.decide_day
            FROM m_purchase pu
            INNER JOIN m_product pr
            ON pu.product_id = pr.id
            WHERE pu.customer_id = ". $_COOKIE['id'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);

}



require_once "./view/PastPurchase.php";
require_once "./view/footer.php";

?>