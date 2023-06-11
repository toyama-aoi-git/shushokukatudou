<?php
require_once "../../../config.php"; //コンフィグは自分の階層で
require_once "./func/function.php";
session_start();

if($_SESSION["insert"] != "完了"){ // ページに入ってきた時
    header("location:index.php");
}
else{
    session_destroy();
}

require_once './view/header.php';
require_once './view/purchase_com.php';
require_once './view/footer.php';



?>
