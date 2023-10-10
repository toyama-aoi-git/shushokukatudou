<?php

    require_once '../../config.php';
    require_once './func.php';
    $default_link = 'login.php';

    if(isset($_POST['state']) && $_POST['state'] == 'insert'){ //ボタンが押されたかで場合分け
         
        if(empty($_POST['loginid']) || empty($_POST['password'])){//入力されたかチェック
            if(empty($_POST['loginid']) && empty($_POST['password'])){
                $err_msg['loginid'] = 'ログインIDを入力してください';
                $err_msg['password'] = 'パスワードを入力してください';
            }elseif(empty($_POST['loginid'])){
                $err_msg['loginid'] = 'ログインIDを入力してください';
            }elseif(empty($_POST['password'])){
                $err_msg['password'] = 'パスワードを入力してください';
            }
            require_once'./tpl/login.php';
        }else{//ログインIDとパスワードが入力されていた
            $hash_login_id = md5($_POST['loginid']);
            $password = $_POST['password'];

            // ログインIDを基にDB内から必要な値を取ってくる
            $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            
                mysqli_set_charset($link,'utf8');
                $result = mysqli_query($link,"SELECT * FROM m_user WHERE hash_login_id = " . '\'' . $hash_login_id . '\'' . ";");
                while($row = mysqli_fetch_assoc($result)){
                    $login_data[] = $row;
                }
                mysqli_close($link);
            
            // var_dump($login_data);
            // データが存在しない場合(入力したIDが存在しないとき)
            if(!isset($login_data)){
                $err_msg['login'] = 'ログインに失敗しました';
            }else{
                // ハッシュ値を作る
                for($i = 0;$i < $login_data[0]['stretch'];$i++){
                    $password = md5($password . $login_data[0]['salt']);
                }             
                
                // echo $password;
                // 入力内容の検証
                if($password == $login_data[0]['password']){
                    setcookie('hash_login_id',$login_data[0]['hash_login_id'],time()+60*60,"/");
                    header('location:./index.php');
                    exit;
                }else{
                    $err_msg['login'] = 'ログインに失敗しました' ;
                }
            }
        }
  }



    //viewの表示
    require_once'./tpl/login.php';
?>