<?php
    date_default_timezone_set('Asia/Tokyo');
    session_start();
    // 完了コメント
    if(isset($_SESSION['complete'])){
        $complete = $_SESSION['complete'];
    }
    $_SESSION['complete'] = [];
    @session_destroy();
    session_start();
    $default_link = 'list.php';
    //config.phpの呼び込み
    require_once '../../config.php';

    // 並び替えボタン
    // 昇順
    if(isset($_POST['state']) && $_POST['state'] == 'ASC'){
        $list = [];
        $fetch_sql = "SELECT *
                     FROM m_book 
                     WHERE del_date is NULL
                     ORDER BY price ASC";
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        if($link != false){
            mysqli_set_charset($link,'utf8');
            $sql_list = mysqli_query($link,$fetch_sql);
            while($row = mysqli_fetch_assoc($sql_list)){
                $list[] = $row;
            }
            mysqli_close($link);
            require_once './tpl/list.php';
            exit;
        }else{
        //接続失敗の時
        require_once './tpl/connect_err.php';
        exit;
        }
    }elseif(isset($_POST['state']) && $_POST['state'] == 'DESC'){
    // 降順
        $list = [];
        $fetch_sql = "SELECT *
                     FROM m_book 
                     WHERE del_date is NULL
                     ORDER BY price DESC";
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        if($link != false){
            mysqli_set_charset($link,'utf8');
            $sql_list = mysqli_query($link,$fetch_sql);
            while($row = mysqli_fetch_assoc($sql_list)){
                $list[] = $row;
            }
            mysqli_close($link);
            require_once './tpl/list.php';
            exit;
        }else{
        //接続失敗の時
        require_once './tpl/connect_err.php';
        exit;
        }   
    }

    //検索
    if(isset($_POST['state']) && $_POST['state'] == 'serch'){
        $list = [];
        $fetch_sql = "SELECT *
                     FROM m_book 
                     WHERE del_date is NULL
                     AND title like '%" . $_POST['word'] . "%'
                     ORDER BY release_date DESC";
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        if($link != false){
            mysqli_set_charset($link,'utf8');
            $sql_list = mysqli_query($link,$fetch_sql);
            while($row = mysqli_fetch_assoc($sql_list)){
                $list[] = $row;
            }
            mysqli_close($link);
            require_once './tpl/list.php';
            exit; 
        }
    }

    // csvダウンロード
    if(isset($_POST['state']) && $_POST['state'] == 'download'){
        $filename = 'book_' . date("Ymdhis") . '.csv';
        header('Content-Type:application/octet-stream');
        header('Content-Disposition:attachment;filename="'.$filename.'"');
        $fetch_sql = "SELECT *
                     FROM m_book ";
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        if($link != false){
            mysqli_set_charset($link,'utf8');
            $sql_list = mysqli_query($link,$fetch_sql);
            while($row = mysqli_fetch_assoc($sql_list)){
                $list[] = $row;
            }
            mysqli_close($link);
            if(isset($list)){
                for($i = 0;$i < count($list);$i++){
                    echo $list[$i]['id'] . ',' . $list[$i]['title'] . ',' . $list[$i]['volume'] . ',' . $list[$i]['price'] . ',' . $list[$i]['release_date'] . ',' . $list[$i]['purchase_date'] . ',' . $list[$i]['del_date'] . PHP_EOL;
                }
            }else{
                echo '';
            }
            exit; 
        }
    }

    $list = [];
    $fetch_sql = "SELECT *
                 FROM m_book 
                 WHERE del_date is NULL 
                 ORDER BY release_date DESC";
    $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    if($link != false){
        mysqli_set_charset($link,'utf8');
        $sql_list = mysqli_query($link,$fetch_sql);
        while($row = mysqli_fetch_assoc($sql_list)){
            $list[] = $row;
        }
        mysqli_close($link);
        require_once './tpl/list.php';
        exit;
    }else{
    //接続失敗の時
    require_once './tpl/connect_err.php';
    exit;
    }
    

?>