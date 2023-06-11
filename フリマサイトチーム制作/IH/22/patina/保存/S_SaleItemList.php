<?php
// require_once "./config.php";
// require_once "./func/function.php";

// session_start();


// // if(isset($_SESSION['id'])){
//     // $id = $_SESSION['id'];

//     $id = "PR0101000237";

//     $sql = "SELECT * FROM m_product WHERE id = '" . $id . "'";
//     $list = select(HOST,USER_ID,PASSWORD, DB_NAME, $sql);

//     $name = $list[0]['name'];
//     $price = $list[0]['price'];
//     $sentence = $list[0]['sentence'];
//     $situation = $list[0]['state'];
//     $img = $list[0]['img_url'];


//     if($situation == 0){    
//         $situation = "非常に良い";
//     }
//     elseif($situation == 1){
//         $situation = "良い";
//     }
//     elseif($situation == 2){
//         $situation = "可";
//     }
//     elseif($situation == 3){
//         $situation = "悪い";
//     }
//     else{
//         $situation = "非常に悪い";
//     }


    
// }






// require_once "./view/SaleItem.php";




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
else{
    header("location:index.php");
}




require_once "./view/header.php";
require_once "./view/S_SaleItemList.php";
require_once "./view/footer.php"    

?>