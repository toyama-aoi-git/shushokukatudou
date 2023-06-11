<?php
    date_default_timezone_set('Asia/Tokyo');
    session_start();
    $default_link = 'delete.php';

        //config.phpの呼び込み
        require_once '../../config.php';

        if(isset($_POST['state'])){ //ボタンが押されたかで場合分け

            $book_id = $_SERVER['QUERY_STRING'];
            $delete_sql = "UPDATE m_book SET del_date = '" . date("Y-m-d") . 
            "' WHERE id = " . $book_id;
    
            $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            if($link != false){
                mysqli_set_charset($link,'utf8');
                mysqli_query($link,$delete_sql);
                mysqli_close($link);
                $_SESSION['complete'] = '削除が完了しました';
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
            }else{
                $main_data['purchase_date'] = '-';
            }
            require_once './tpl/delete.php';
            exit;
        }else{
        // 接続失敗の時
        require_once './tpl/connect_err.php';
        exit;
        }
        
    
    ?>
?>