<?php
    date_default_timezone_set('Asia/Tokyo');
    require_once './func.php';
    require_once '../../config.php';

    $id = $_GET['id'];
    // 指定した新着情報の詳細を取ってくる
    $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    mysqli_set_charset($link,'utf8');
    $result[] = mysqli_query($link,"SELECT * FROM m_news where id = $id ;");
    while($row = mysqli_fetch_assoc($result[0])){
        $news[] = $row;
    }
    mysqli_close($link);   


    var_dump($news);

    // 日本語、用紙設定
    require_once PDF_DIR . 'autoload.php';
    $mpdf = new \Mpdf\Mpdf([
        'fontdata' => [
            'ipa' => [
                'R' => 'ipag.ttf'
            ]
            ],
            'format' => 'A4-P',
            'mode' => 'ja',
    ]);

    // PDFへ出力
    $mpdf -> WriteHTML('<p>' . $news[0]['content'] . '</p>');

    // PDF出力
    $mpdf -> Output('dl_' . date(YmdHis) . '.pdf','D');

    require_once './tpl/data.php';
?>