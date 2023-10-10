<?php
require_once "./func/function.php";
require_once "../../config.php";

$error_img ="";
$error_pass ="";
session_start();
if(isset($_GET['id'])){
    $register_id = $_GET['id'];
}
elseif(isset($_POST['login_id'])){
    $register_id = $_POST['login_id'];
}

$sql = "SELECT * FROM m_user WHERE hash_login_id = '" . $register_id . "'";
$list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
if(isset($_POST['btn'])){ //フォームが飛んできたら
    $flg = true;

    if($_POST['pass'] == ""){//パスワードチェック
        $error_pass = "値を入力してください";
        $flg = false;
    }
    $tmp = $_FILES['img']['tmp_name'];
    $file_name = $_FILES['img']['name'];
    $extension = getExtension($file_name);
    if(
        $extension == "jpeg"||
        $extension == "png" ||
        $extension == "jpg" ||
        $extension == "gif" || 
        $extension == "JPEG"||
        $extension == "JPG" ||
        $extension == "PNG" ||
        $extension == "GIF" 
        ){}
        else{
            $error_img = "登録できない拡張子です";
            $flg = false;
        }
        if($_FILES['img']['name'] == ""){//画像チェック
            $error_img = "画像を選択してください";
            $flg = false;
        }
    if($flg){//チェックがOKなら
        $pass = $_POST['pass'];
        $i =0;
        while(true){
            $pass = md5($pass . $list[0]['salt']);
            $i++;
            if($i == $list[0]['stretch']){
                break;
            }
        }
        if($pass == $list[0]['password']){
            $link = sql_start(HOST, USER_ID, PASSWORD, DB_NAME);
            if($link != false){
                $img_size = getimagesize($_FILES['img']['tmp_name']); //画像サイズ
                $ratio = [];
                $ratio = ratio_img($img_size[0], $img_size[1], 60, 70);
                $directory = DIR_IMG . "user/" . $list[0]['id'];
                mkdir($directory, 0700);
                move_uploaded_file($tmp,DIR_IMG . "user/" . $list[0]['id'] . "/" .$file_name);
                compression_img(DIR_IMG . "user/" . $list[0]['id'] . "/" .$file_name ,DIR_IMG . "user/" . $list[0]['id'] . "/thumb_" . $file_name , $extension, $ratio[0], $ratio[1], $img_size[0], $img_size[1]);
                
                
                $sql = "UPDATE m_user 
                        SET user_state = 1,
                            file_name = 'thumb_" . $file_name . "' 
                            WHERE id = " . $list[0]['id'];
                mysqli_query($link , $sql);
                $_SESSION['id'] = $list[0]['id'];
                header("location:regi_comp.php");
                exit;
            }
        }
        else{
            $error_pass = "パスワードが間違っています";
        }
    }
}

require_once "./tmp/register.php";
?>
