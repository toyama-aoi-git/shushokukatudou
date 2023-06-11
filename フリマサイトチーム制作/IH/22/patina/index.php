<?php

require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
require_once "./view/header.php";

//////////////////////// ログアウトボタンが押された場合 /////////////////////////////
if(isset($_POST['logout'])){
    setcookie('id', "", time() - 600);
}

setcookie("id" , "1", time() + 24 * 60);

///////////////////////// クッキーが存在している場合 //////////////////////////
if(isset($_COOKIE['id'])){ 
    $id = $_COOKIE['id'];

    //ユーザー情報の取得
    $sql = "SELECT * FROM m_customer WHERE id =" . $id;
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql); 
    
    if(isset($_GET['mypage'])){ //マイページに遷移
        header("location:mypage.php");
        exit;
    }
    elseif(isset($_GET['pointShop'])){ //ポイントショップに遷移
        header("location:pointShop.php");
        exit;
    }
    elseif(isset($_GET['myList'])){//マイリストに遷移
        header("location:myList.php");
        exit;
    }
    elseif(isset($_GET['SNS'])){//SNSに遷移
        header("location:SNS.php");
        exit;
    }
    elseif(isset($_GET['item'])){//選択された販売商品画面に遷移

        header("location:SaleItem.php");
        exit;
    }
    // elseif(isset($_GET['genre'])){

    //     header("location:SaleItemList.php");
    //     exit;
    // }


    

    if(isset($_POST['logout'])){ // 出品ボタンをクリックした時
        header("location:display.php");
        exit;
    }

    ///////////////////////////////////// 検索のやつ
    if(isset($_GET['searchWord'])){
        header("location:S_SaleItemList.php?search=". $_GET['searchWord'] ."");
    }
}

///////////////////////////////// 出品された商品の一覧取得

$sql = "SELECT id , name , img_url , price
        FROM m_product
        WHERE sale IS NULL";
$list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);


///////////////////////////////// 商品をクリックした時

///////////////////////////////// おすすめ商品
if(isset($_GET['label'])){
    header("location:productdetails.php?id=". $_GET['label'] ."");
}

///////////////////////////////// おすすめジャンル
if(isset($_GET['genre'])){
    header("location:S_SaleItemList.php?genre=". $_GET['genre'] ."");
}


/////////////////////////////// 出品履歴
if(isset($_GET['past'])){
    header("location:PastPurchase.php?id=". $_COOKIE['id'] ."");
}


/////////////////////////////// 購入履歴
if(isset($_GET['product'])){
    header("location:ProductList.php?id=". $_COOKIE['id'] ."");
}


require_once "./view/index.php";
require_once './view/footer.php';

?>