<?php
        require_once '../../config.php';
        // entry.phpから飛んできた場合
        session_start();
        if(isset($_SESSION)){
            // データを受け取った後セッションを消す
            
            $name = $_SESSION['name'];
            $loginid = $_SESSION['loginid'];
            $password = $_SESSION['password'];
            $mail_address = $_SESSION['mail_address'];
            $view_password = '';
        
            

            // パスワードを＊に変換
            for($i = 0;$i < strlen($password);$i++){
                $view_password .= str_replace($password,'＊',$password);
            }
        }



        if(isset($_POST['state']) && $_POST['state'] == 'return'){ //ボタンが押されたかで場合分け
        // entry_comfirmation.phpから飛んできた場合
            // entry.phpに戻る
            header('location:./entry.php?return=1');
            exit;
        }elseif(isset($_POST['state']) && $_POST['state'] == 'insert'){

            session_destroy();

            // 続きはここから（DBに登録）
            $salt = uniqid();//ソルトの値
            $stretch = rand(1000,10000);
            // DBに格納するハッシュ値を作製する
            for($i = 0;$i < $stretch;$i++){
                $password = md5($password . $salt);
            }


            // DBに格納する「hash_login_id」を作る
            $hash_login_id = md5($loginid);
            // insert文を作る
            $insert_sql ="INSERT INTO m_user (name,mail,login_id,password,hash_login_id,salt,stretch,user_state) VALUES (" . '\'' . $name . '\'' . "," . '\'' . $mail_address . '\'' . "," . '\'' . $loginid . '\'' . "," . '\'' . $password . '\'' . "," . '\'' . $hash_login_id . '\'' . "," . '\'' . $salt . '\'' . "," . $stretch . "," . 0 . ");";

            // // 以下sql実行とページ遷移
            $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            mysqli_set_charset($link,'utf8');
            mysqli_query($link,$insert_sql);
            mysqli_close($link);
            header("location:./entry_complete.php?id=" . $hash_login_id);
            exit;
        }
        // viewの表示
        require_once './tpl/entry_comfirmation.php';

?>