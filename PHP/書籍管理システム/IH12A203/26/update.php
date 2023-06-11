<?php
    session_start();

    $default_link = 'update.php';
    //config.phpの呼び込み
    require_once '../../config.php';

    if(isset($_POST['state'])){ //ボタンが押されたかで場合分け
        //入力値チェック
            // タイトル
            if(strlen($_POST['title']) == 0){
                $err_msg['title'] = 'タイトルが未入力です' ;
            }
            else{
                $title = $_POST['title'];  
            }
            // 巻数
            if(strlen($_POST['volume']) == 0){
                $err_msg['volume'] = '巻数が未入力です' ;
            }elseif(is_numeric($_POST['volume']) == false){
                $err_msg['volume'] = '数値を入力してください';
            }else{
                $volume = $_POST['volume'];
            }
            
            //価格
            if(strlen($_POST['price']) == 0){
                $err_msg['price'] = '価格が未入力です' ;
            }elseif(is_numeric($_POST['price']) == false){
                $err_msg['price'] = '数値を入力してください';
            }else{
                $price = $_POST['price'];
            }
        
        
            // 発売日
            if(strlen($_POST['release_date']) == 0){
                $err_msg['release_date'] = '発売日が未入力です' ;
            }elseif(is_numeric($_POST['release_date']) == false){
                $err_msg['release_date'] = '数値を入力してください';
            }elseif(strlen($_POST['release_date']) != 8){
                $err_msg['release_date'] = '８桁で入力してください';
            }else{
                $release_date = $_POST['release_date'];
            }
        
            if(strlen($_POST['purchase_date']) == 0){
                $purchase_date = 'nothing';
            }elseif(is_numeric($_POST['purchase_date']) == false){
                $err_msg['purchase_date'] = '数値を入力してください';
                $purchase_date = 'err';
            }elseif(strlen($_POST['purchase_date']) != 8){
                $err_msg['purchase_date'] = '８桁で入力してください';
                $purchase_date = 'err';
            }else{
                $purchase_date = $_POST['purchase_date'];
            }





        if(!isset($err_msg)){
            if(strlen($_POST['purchase_date']) != 0){
                $update_sql = "UPDATE m_book SET title = '" . $title . 
                "',volume = '" . $volume . 
                "',price = '" . $price .
                "',release_date = '" . $release_date .
                "',purchase_date = '" . $purchase_date . "'" . 
                " WHERE id = " . $_POST['id'];
            }elseif($purchase_date == 'nothing'){
                $update_sql = "UPDATE m_book SET title = '" . $title . 
                "',volume = '" . $volume . 
                "',price = '" . $price .
                "',release_date = '" . $release_date . 
                "',purchase_date = NULL " . 
                "WHERE id = " . $_POST['id'];
            }
        }

        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        if($link != false && !isset($err_msg)){
            mysqli_set_charset($link,'utf8');
            $sql_list = mysqli_query($link,$update_sql);
            mysqli_close($link);
            $_SESSION['complete'] = '変更が完了しました';
            header('location:./list.php');
            exit;
        }
    }

    $book_id = $_SERVER['QUERY_STRING'];
    $main_data = [];
    $fetch_sql = "SELECT * FROM m_book WHERE id = " . $book_id;
    $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    if($link != false){
        mysqli_set_charset($link,'utf8');
        $sql_list = mysqli_query($link,$fetch_sql);
        while($row = mysqli_fetch_assoc($sql_list)){
            $main_data = $row;
        }
        mysqli_close($link);
        
        $main_data['release_date'] = str_replace('-', '', $main_data['release_date']);
        // echo $list[$book_id]['purchase_date'];
        if($main_data['purchase_date'] != NULL){
            $main_data['purchase_date'] = str_replace('-', '', $main_data['purchase_date']);
        }
        require_once './tpl/update.php';
        exit;
    }else{
    //接続失敗の時
    // require_once './tpl/connect_err.php';
    // exit;
    }
    

?>