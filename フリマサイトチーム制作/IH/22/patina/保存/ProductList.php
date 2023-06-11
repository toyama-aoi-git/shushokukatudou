<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
require_once "./view/header.php";

if(!isset($_GET["id"])){ // ページに入ってきた時
    header("location:index.php");
}
else{

    $sql = "SELECT p.id , p.name , p.img_url , p.price
            FROM m_product p
            INNER JOIN t_exhibit e
            ON p.id = e.product_id
            WHERE e.customer_id = ". $_COOKIE['id'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);

}




require_once "./view/ProductList.php";
require_once "./view/footer.php";
?>