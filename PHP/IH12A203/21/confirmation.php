<?php
require_once "./func/function.php";
require_once "../../config.php";
session_start();

if(isset($_SESSION['name'])){

    if(isset($_POST['back'])){
        $_SESSION['back'] = "back";
        header("location:entry.php");
        exit;
    }
    elseif(isset($_POST['register'])){
        $hash_login_id = md5($_SESSION['login']);
        $pass = $_SESSION['pass'];
        $salt = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) ;
        $str_cnt = rand(1000, 10000);
        $i =0;
        while(true){
            $pass = md5($pass . $salt);
            $i++;
            if($i == $str_cnt){
                break;
            }
        }
        $name = $_SESSION['name'];
        $mail = $_SESSION['mail'];
        $login_id = $_SESSION['login'];
        $sql = "INSERT INTO m_user(name, mail, login_id, password, hash_login_id, salt, stretch, user_state)  
                VALUES('". $name . "','" . $mail . "','" . $login_id . "','" . $pass . "','" . $hash_login_id . "'," . $salt . "," . $str_cnt . ",0)";
                echo $sql;
        insert(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
        unset($_SESSION['name']);
        unset($_SESSION['login']);
        unset($_SESSION['mail']);
        unset($_SESSION['pass']);
        $_SESSION['hash'] = $hash_login_id;
        header("location:complete.php");
        exit;
    }
}

require_once "./tmp/confirmation.php";
?>


