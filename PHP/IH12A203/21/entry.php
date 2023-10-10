<?php
require_once "./func/function.php";
session_start();

$error_msg_id = "";
$error_msg_name = "";
$error_msg_mail = "";
$error_msg_pass = "";
$pass_again = "";


if(isset($_SESSION['back'])){
    $error_msg_pass = "再入力してください";
}
if(isset($_POST['register'])){


    $name = $_POST['name'];
    $login_id = $_POST['login_id'];
    $pass = $_POST['pass'];
    $mail = $_POST['mail'];

    $flg = true;
    $passFlg = false;
    if($name == ""){
        $error_msg_name = "値を入力してください";
        $passFlg = true;
        $flg = false;
    }

    if($login_id == ""){
        $error_msg_id = "値を入力してください";
        $passFlg = true;
        $flg = false;
    }

    if($mail == ""){
        $error_msg_mail = "値を入力してください";
        $passFlg = true;
        $flg = false;
    }
    elseif(preg_match('/@/', $mail) === 0){
        $error_msg_mail = "メールアドレスの形式で入力してください";
        $flg = false;
        $passFlg = true;
    }

    if($passFlg){
        $error_msg_pass = "再入力してください";
    }
    if($pass == ""){
        $error_msg_pass = "値を入力してください";
        $flg = false;
    }


    if($flg == true){

        $_SESSION['name'] = $name;
        $_SESSION['login'] = $login_id;
        $_SESSION['pass'] = $pass;
        $_SESSION['mail'] = $mail;
        header("location:confirmation.php");
        exit;
    }
    else{
        $_SESSION['name'] = $name;
        $_SESSION['login'] = $login_id;
        $_SESSION['mail'] = $mail;
    }
}



require_once "./tmp/entry.php";
session_destroy();
?>