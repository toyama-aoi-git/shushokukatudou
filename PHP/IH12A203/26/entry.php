<?php

    require_once '../../config.php';
    $default_link = 'entry.php';
    session_start();


    if(isset($_SESSION['password']) || isset($session['name']) || isset($session['loginid']) || isset($session['mail_address'])){
        $err_msg['password'] = 'お手数ですがもう一度パスワードを入力してください';
    }

    if(isset($_SESSION['name'])){
        
        session_destroy();
    }
    
    if(isset($_POST['state']) && $_POST['state'] == 'insert'){ //ボタンが押されたかで場合分け


        //nameの空白チェック
        if(strlen($_POST['name']) == 0){
            $err_msg['name'] = '名前が未入力です' ;
        }
        else{
            $name = $_POST['name'];
        }

        //loginidの空白チェック
        if(strlen($_POST['loginid']) == 0){
            $err_msg['loginid'] = 'ログインIDが未入力です' ;
        }
        else{
            $loginid = $_POST['loginid'];
        }
        





        //mail_addressの空白チェック&妥当性チェック
        if(strlen($_POST['mail_address']) == 0){
            $err_msg['mail_address'] = 'メールアドレスが未入力です' ;
        }
        elseif(preg_match('/@/',$_POST['mail_address']) === 0){
            $err_msg['mail_address'] = 'メールアドレスが正当なものではありません';
        }
        else{
            $mail_address = $_POST['mail_address'];
        }


                //passwordの空白チェック
                if((!isset($_SESSION['password'])) && (strlen($_POST['password']) != 0) && isset($err_msg)){
                    $err_msg['password'] = 'お手数ですがもう一度パスワードを入力してください';
                }
                elseif(strlen($_POST['password']) == 0){
                    $err_msg['password'] = 'パスワードが空です。' ;
                }
                else{
                    $password = $_POST['password'];
                }

        // 確認画面へデータをセッションで送る
        if(!isset($err_msg)){
            
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['loginid'] = $loginid;
            $_SESSION['password'] = $password;
            $_SESSION['mail_address'] = $mail_address;
            header('location:./entry_comfirmation.php');
            exit;
        }

        

    }
    //viewの表示
    require_once './tpl/entry.php';
?>