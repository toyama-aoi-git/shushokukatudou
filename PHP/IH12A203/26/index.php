<?php



    if(!isset($_COOKIE['hash_login_id'])){
        //未ログイン
        header('location:./login.php');
        exit;
    }else{
        //ログイン済み

        require_once '../../config.php';
        require_once './func.php';
        $default_link = 'index.php';

        $hash_login_id = $_COOKIE['hash_login_id'];
        // nameをDBから取ってくる
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            mysqli_set_charset($link,'utf8');
            $result[] = mysqli_query($link,"SELECT * FROM m_user WHERE hash_login_id = " . "'" . $hash_login_id . "';");
            while($row = mysqli_fetch_assoc($result[0])){
                $data[] = $row;
            }
            mysqli_close($link);


            // サムネ
            $thumb = DIR_IMG . 'user/' . $data[0]['id'] . '/' . 'thumb_' . $data[0]['file_name'];

            // // 新着情報の一覧を表示する
            // $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            // mysqli_set_charset($link,'utf8');
            // $result[] = mysqli_query($link,"SELECT * FROM m_news ORDER BY created_at DESC;");
            // // var_dump($result);
            // while($row = mysqli_fetch_assoc($result[1])){
            //     $news[] = $row;
            // }
            // mysqli_close($link);   



            // ページャー
    // 合計件数
    $amount = number(HOST,USER_ID,PASSWORD,DB_NAME,'m_news');

    $num1 = $amount[0]['count(id)'];


    // 一ページに表示する件数
    $num2 = 5;

    // ページの件数の最大値
    $max_page = 0;

    while($num1 > 1){
        $num1 = $num1 - $num2;
        $max_page = $max_page + 1;
    }

    // 余りが出たとき
    if($num1 > 0){
        $max_page = $max_page + 1;
    }
    // 指定ページを表す変数
    $specify_num = 0;

    if(isset($_GET['specify_num'])){
        $specify_num = $_GET['specify_num'];
    }

    if(isset($_GET['specify_num'])){
        $specify_num = $_GET['specify_num'];
        if($specify_num > $max_page){
            $specify_num = $max_page - 1;
        }
        elseif($specify_num < 0){
            $specify_num = 0;
        }
    }


    // ページの開始
    $start_num = $specify_num * $num2;

    // 該当データを呼び出してくる
    $news[] = data(HOST,USER_ID,PASSWORD,DB_NAME,'m_news','created_at','DESC',$start_num,$num2);


    // var_dump($news);

    


        //ログアウト処理
        if(isset($_POST['state']) && $_POST['state'] == 'logout'){
            setcookie('hash_login_id','',time()-60,"/");
            header('location:./login.php');
            exit;
        }
    }



    //viewの表示
    require_once'./tpl/index.php';
?>