console.log("googleMaps");

let map;

function initMap() {
    // 地図のオプション設定
    // latlng（オブジェクト）を作成する
    let latlng = new google.maps.LatLng(34.699875, 135.493032);
    let opts = {
        zoom: 16,//ズームレベルの設定　1（広域）〜21（詳細）
        center: latlng,//マップの中央位置の指定（緯度・経度）
        // 下記、コントロール
        mapTypeControl: false, //マップタイプ コントロール
        fullscreenControl: false, //全画面表示コントロール
        streetViewControl: false, //ストリートビュー コントロール
        zoomControl: false, //ズーム コントロール
        
        tilt: 45,
        
        //マップタイプ
        mapTypeId: google.maps.MapTypeId.ROADMAP
        //ROADMAP
        //SATELLITE
        //HYBRID
        //TERRAIN（地形図）
    };//opts

    // map(オブジェクト)を作成
    map = new google.maps.Map(document.getElementById("map_canvas"), opts);

    // marker(オブジェクト)を作成する
    let marker = new google.maps.Marker({
        position:latlng,//表示する緯度、経度
        map:map,//表示するマップオブジェクト
    });//Marker

    // 情報ウィンドウ(吹き出しオブジェクトを作る)
    let infoWindow = new google.maps.InfoWindow({
        content:'<div>HAL大阪</div>'//吹き出しで表示するコンテンツを決める
    });

    // infoWindow.open(map, marker);
    // markerにクリックイベントを設定
    marker.addListener('click',function(){
        console.log('move');
        infoWindow.open(map, marker);
    });

}//initMap

// selectmapイベント
$('#selectmap').change(function(){
    // console.log('select map change');
    let selectmapid = $(this).val();

    switch(selectmapid){
        case '0':
            map.setMapTypeId('roadmap');//24行目のmapに指示
            break;    
        case '1':
            map.setMapTypeId('satellite');//24行目のmapに指示
            break;
        case '2':
            map.setMapTypeId('hybrid');//24行目のmapに指示
            break;
        case '3':
            map.setMapTypeId('terrain');//24行目のmapに指示
            break;
    }
 });


// mapbuttonイベント
$('input[name="mapbutton"]').change(function(){
    console.log($(this).val());

    let selectmapbutton = $(this).val();//セレクトボックスの内容格納

    let option;
    if(selectmapbutton == "true"){
        option = {
            mapTypeControl:true
        }
    }else if(selectmapbutton == "false"){
        option = {
            mapTypeControl:false
        }
    }

    map.setOptions(option);
});

// fullscreenControlイベント
$('input[name="fullscreenControl"]').change(function(){
    console.log($(this).val());

    let selectmapbutton2 = $(this).val();//セレクトボックスの内容格納

    let option;
    if(selectmapbutton2 == "true"){
        option = {
            fullscreenControl:true
        }
    }else if(selectmapbutton2 == "false"){
        option = {
            fullscreenControl:false
        }
    }

    map.setOptions(option);
});

// streetViewControlイベント
$('input[name="streetViewControl"]').change(function(){
    console.log($(this).val());

    let selectmapbutton3 = $(this).val();//セレクトボックスの内容格納

    let option;
    if(selectmapbutton3 == "true"){
        option = {
            streetViewControl:true
        }
    }else if(selectmapbutton3 == "false"){
        option = {
            streetViewControl:false
        }
    }

    map.setOptions(option);
});

// zoomControlイベント
$('input[name="zoomControl"]').change(function(){
    console.log($(this).val());

    let selectmapbutton4 = $(this).val();//セレクトボックスの内容格納

    let option;
    if(selectmapbutton4 == "true"){
        option = {
            zoomControl:true
        }
    }else if(selectmapbutton4 == "false"){
        option = {
            zoomControl:false
        }
    }

    map.setOptions(option);
});
