<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-type: application/xml; charset=UTF-8");
    $url = $_GET['url'];
    $xml = file_get_contents($url);
    echo $xml;
?>