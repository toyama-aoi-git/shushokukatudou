<?php
require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
session_start();
if(isset($_POST['itemDisplay'])){ /////// 出品するボタンをクリックした時
    $flag = true;
    if(isset($_FILES['itemImage'])){ /////////////// 画像有無チェック
        $tmp = $_FILES['itemImage']['tmp_name'];
        $file_name = $_FILES['itemImage']['name'];
    }
    else{
        $imageErroe = "画像を選択してください";
    }
    ///////////////////////////////////////// 送られてきた値を変数に入れる
    $state = $_POST['itemState'];
    $itemName = $_POST['itemName'];
    $explanation = $_POST['itemExplanation'];
    $shippingTime = $_POST['shippingTime'];
    $itemPrice = $_POST['itemPrice'];
    $genre_id = $_POST['genre'];
    $kinds_id = $_POST['kinds'];
    ////////////////////////////////////////////////// 入力チェック
    if($itemName == ""){
        $nameError = "値を入力してください";
        $flag = false;
    }
    if($explanation == ""){
        $explanationError = "値を入力してください";
        $flag = false;
    }
    if($itemPrice == ""){
        $priceError = "値を入力してください";
        $flag = false;
    }
    elseif(!is_numeric($itemPrice)){
        $priceError = "値は数値で入力してください";
        $flag = false;
    }
    //////////////// 入力値がすべて正しい場合
    if($flag){
        //////////////////////////////////// DBに登録
        $aaa = getExtension($file_name);
        $sql = "SELECT MAX(id)
                FROM m_product";
        $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
        var_dump($list);
        $list[0]["MAX(id)"]++;
        $plus_img = $list[0]["MAX(id)"].'.'.$aaa;
        $sql = "INSERT INTO m_product(name, img_url, price, sentence, genre_id, kinds_id, state)
                VALUES ('" . $itemName . "','" . $plus_img . "'," .$itemPrice. ",'" . $explanation . "'," . $genre_id . "," . $kinds_id . ",". $state .")";
        $id = insert(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
        $sql_sql = "INSERT INTO t_exhibit(customer_id , product_id)
                    VALUES (". $_COOKIE['id'] ." , ". $id .")";
        insert(HOST, USER_ID, PASSWORD, DB_NAME, $sql_sql);
        /////////////////////////////////// 画像サイズ編集＆保存
        move_uploaded_file($tmp, './img/'.$plus_img);
        ////////////////////////////////// 操作完了後、画面遷移
        $_SESSION["insert"] = "完了";
        header("location:DisplayComplete.php");
        exit;
    }
}
require_once './view/header.php';
require_once './view/display.php';
require_once './view/footer.php';
?>