<?php
require_once "./func/function.php";
require_once "../../config.php";
session_start();

if(isset($_SESSION['id'])){
    

    //メール送信
    // $sql = "SELECT * FROM m_user WHERE hash_login_id = '" . $_SESSION['hash']. "'";
    // $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);

    // mb_language("Japanese");
    // mb_internal_encoding("UTF-8");

    // $mailTo = $list[0]['mail'];
    // $title = "本登録メール";
    // $message = "下記URLから本登録を完了してください\n
    //             <a>" . BASE_URL  . "21/register.php?hash=" . $_SESSION['hash'] . "</a>";
    // $headers = "FROM:" . FROM;

    // mb_send_mail($mailTo, $title, $message, $headers);
}


require_once "./tmp/complete.php";
?>