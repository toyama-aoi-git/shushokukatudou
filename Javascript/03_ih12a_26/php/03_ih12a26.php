<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-type: application/xml; charset=UTF-8");
    $area_url='http://jws.jalan.net/APICommon/AreaSearch/V1/';
    $key_value="?key=leo16612c23f5b";

    // if(array_key_exists( 'reg',$_GET)){
    //     $url = $area_url . $key_value . '&reg=' . $_GET['reg']; 
    // }else if(array_key_exists( 's_area',$_GET)){
    //     $url = 'http://jws.jalan.net/APIList/HotelSearch/V1/';
    //     $key_value . '&s_area=' . $_GET['s_area'];
    // }else{
    //     $url = $area_url . $key_value;
    // }
    // $xml = file_get_contents($url);
    // echo $xml;


    if(array_key_exists( 'reg',$_GET)){ //地域
        $url = $area_url . $key_value . '&reg=' . $_GET['reg']; 
    }else if(array_key_exists( 'ref',$_GET)){ //都道府県
        $url = $area_url . $key_value . '&pref=' . $_GET['ref'];
    }else if(array_key_exists( 'l_area',$_GET)){ //大エリア
        $url = $area_url . $key_value . '&l_area=' . $_GET['l_area'];
    }
    else if(array_key_exists( 's_area',$_GET)){ //小エリア
        $url = 'http://jws.jalan.net/APILite/HotelSearch/V1/' . $key_value . '&s_area=' . $_GET['s_area'];
    }else{
        $url = $area_url . $key_value;
    }
    $xml = file_get_contents($url);
    echo $xml;
?>