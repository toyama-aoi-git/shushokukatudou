<?php

use setasign\Fpdi\PdfReader\Page;

require_once "./func/function.php";
require_once "../../config.php";

require_once PDF_DIR . 'autoload.php';
date_default_timezone_set('Asia/Tokyo');

$mpdf = new \Mpdf\Mpdf([
    'fontdata' =>[
        'ipa' => [
            'R' => 'ipag.ttf'
        ]
        ],
        'format' => 'A4-P',
        'made' => 'ja'
]);

$flag = false;

if(!isset($_COOKIE['id'])){
    header("location:login.php");
    exit;
}

if(isset($_POST['logout'])){
    setcookie('id', "" , time() - 1000);
    header("location:login.php");
    exit;
}

if(isset($_COOKIE['id'])){
    $sql = "SELECT * FROM m_user WHERE id = " . $_COOKIE['id'];
    $list = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
    $name = $list[0]['name'];
    $fileName = $list[0]['file_name'];
    $id = $list[0]['id'];

    if(isset($_GET['page'])){
        if($_GET['page'] == 'low'){
            $page = $_GET['num'] - 5;
            $num = $page;
        }
        elseif($_GET['page'] == 'high'){
            $page = $_GET['num'] + 5;
            $num = $page;
        }
    }
    else{
        $page = 0;
        $num = 0;
    }

    if(isset($_GET['news'])){
        $page = $_GET['news'] / 5;
        $num = $page;
    }
    
    if(isset($_GET['list'])){
        $page = $_GET['list'] * 5;
        $num = $page;
    }

    $sql = "SELECT count(*) as 件数 FROM m_news";
    $news_count = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);


    $sql = "SELECT * FROM m_news ORDER BY created_at LIMIT " . $page. ", 5" ;
    $news = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
    $link = @mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);
    $list = [];
    if($link != false){
        mysqli_set_charset($link , 'utf8');
        $sql = "select * from m_news";
                $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $list[] = $row;
        }
        mysqli_close($link);
        $cnt2 = count($list);
        $page_list = $cnt2 / 5;
        if($news_count[0]['件数'] > $page + 5){
            $flag = true;
        }
    }

    if(isset($_GET['news'])){

        echo $_GET['news'];
        $sql = "SELECT * FROM m_news WHERE id = " . $_GET['news'];
        $select_news = select(HOST, USER_ID, PASSWORD, DB_NAME, $sql);
        $mpdf -> WriteHTML('<hr>');
        $mpdf -> WriteHTML('<p>'. $select_news[0]['title'] .'</p>');
        $mpdf -> WriteHTML('<p>'. $select_news[0]['content'].'</p>');
        $mpdf -> WriteHTML('<p>'. $select_news[0]['created_at'].'</p>');

        $mpdf -> Output('dl_'. date('YmdHis').'.pdf','D');
    }

}
require_once "./tmp/index.php";
?>

