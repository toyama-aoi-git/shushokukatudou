<?php
    require_once '../../config.php';
    require_once './func.php';

    $id = $_GET['id'];

    $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    mysqli_set_charset($link,'utf8');
    $result = mysqli_query($link,"SELECT mail FROM m_user where hash_login_id = '" . $id . "';");
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    mysqli_close($link);

    $mail = $data[0]['mail'];

    // 以下メール送信
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $mailto = $mail;
    $title = "本会員登録のお願い";
    $message = "仮登録が完了しました。以下のリンクから本登録へ移行してください" . "\r\n" . '<a href="' . BASE_URL . '26/official_registration.php?id=' . $id . '">' . BASE_URL . '26/official_registration.php?id=' . $id . '</a>';
    $headers = "FROM:" . FROM;

    if(mb_send_mail($mailto,$title,$message,$headers)){
        echo "送信成功";
    }else{
        echo '送信失敗';
    }

    require_once './tpl/entry_complete.php';
?>