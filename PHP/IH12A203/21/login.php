<?php
require_once "./func/function.php";
require_once "../../config.php";

$error = "";
if(isset($_POST['login'])){
    $login_id = $_POST['id'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM m_user WHERE login_id = '" . $login_id ."'";
    $user = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
    
    if(!empty($user)){
        $i =0;
        while(true){
            $pass = md5($pass . $user[0]['salt']);
            $i++;
            if($i == $user[0]['stretch']){
                break;
            }
        }

        $sql = "SELECT *
                FROM m_user
                WHERE login_id = '" . $login_id . "'
                AND password = '" . $pass . "'";
        $login = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);

        if(!empty($login)){
            setcookie("id" , $login[0]['id'], time() + 24 * 60);
            header("location:index.php");
            exit;
        }
    }
    else{
        $error = "ログインIDまたはパスワードが違います";
    }
}

require_once "./tmp/login.php";
?>
