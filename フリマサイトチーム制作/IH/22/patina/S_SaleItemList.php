<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
require_once "./view/header.php";


//////////////////////////////////// 文字検索
if(isset($_GET['search'])){
    $sql = "SELECT id , name , img_url , price , sentence
            FROM m_product
            WHERE name LIKE '%". $_GET['search'] ."%'";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
}

///////////////////////////////////// おすすめジャンル
elseif(isset($_GET['genre'])){
    $sql = "SELECT id , name , img_url , price , sentence
            FROM m_product
            WHERE genre_id = ". $_GET['genre'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
}

///////////////////////////////////////////////////////// ジャンルとかの検索
elseif(isset($_POST['genre']) && isset($_POST['kinds'])){
    $sql = "SELECT id , name , img_url , price , sentence
            FROM m_product
            WHERE genre_id = ". $_POST['genre'] ."
            AND kinds_id = ". $_POST['kinds'] ."";
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
}

else{
    header("location:index.php");
}

if(isset($_GET['id'])){
    header("location:productdetails.php?id=". $_GET['id'] ."");
}




require_once "./view/S_SaleItemList.php";
require_once './view/footer.php';
?>