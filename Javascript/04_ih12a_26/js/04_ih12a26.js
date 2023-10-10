"use strict";

let marker_image = './img/10357.png';


// 本来は課題No03を参考にjaranAPIにて下記の処理を実施
// １）起動したら地域を取得する
$.ajax({
    type:'GET',
    url:'./php/04_ih12a26.php',
    cache:false
})
.done(function(data){
    $('#jaranregion').append($('<option>').html("-------地域を選択してください-------").val(0));
    // $('#jaranprefecture').append($('<option>').html("-----都道府県を選択してください-----").val(0));
    // $('#jaranlargearea').append($('<option>').html("-----大エリアを選択してください-----").val(0));
    // $('#jaransmallarea').append($('<option>').html("-----小エリアを選択してください-----").val(0));
    $(data).find('Region').each((index,element)=>{
        const cdTxt = $(element).attr('cd');
        const nameTxt = $(element).attr('name');

        $('#jaranregion').append($('<option>').html(nameTxt).val(cdTxt));
    })//find
}).fail(function( jqXHR, textStatus, errorThrown){
    console.log(textStatus);
});

// ２）地域を選択して都道府県を取得
$('#jaranregion').on('change',(event)=>{
    const selectRegion = $('#jaranregion').val();
    // 「XXXを選択してください」が押されたら下位のセレクトボックスをクリアし、returnする。
    $('#jaranprefecture').empty();
    $('#jaranprefecture').append($('<option>').html("-----都道府県を選択してください-----").val(0));
    $('#jaranlargearea').empty();
    // $('#jaranlargearea').append($('<option>').html("-----大エリアを選択してください-----").val(0));
    $('#jaransmallarea').empty();
    // $('#jaransmallarea').append($('<option>').html("-----小エリアを選択してください-----").val(0));

    $.ajax({
        type:'GET',
        data:{
            reg:selectRegion
        },
        url:'./php/04_ih12a26.php',
        chache:false
    })
    .done((data)=>{
        $(data).find('Prefecture').each((index,element)=>{
            const cdTxt = $(element).attr('cd');
            const nameTxt = $(element).attr('name');

            $('#jaranprefecture').append($('<option>').html(nameTxt).val(cdTxt));
        })//find
    })//done
    .fail(()=>{
        console.log(textStatus);
    })//fail

})


// ３）都道府県を選択して大エリアを取得
$('#jaranprefecture').on('change',(event)=>{
    const selectPrefecture = $('#jaranprefecture').val();
    $('#jaranlargearea').empty();
    $('#jaranlargearea').append($('<option>').html("-----大エリアを選択してください-----").val(0));
    $('#jaransmallarea').empty();
    // $('#jaransmallarea').append($('<option>').html("-----小エリアを選択してください-----").val(0));

    $.ajax({
        type:'GET',
        data:{
            ref:selectPrefecture
        },
        url:'./php/04_ih12a26.php',
        chache:false
    })
    .done((data)=>{
        $(data).find('LargeArea').each((index,element)=>{
            const cdTxt = $(element).attr('cd');
            const nameTxt = $(element).attr('name');

            $('#jaranlargearea').append($('<option>').html(nameTxt).val(cdTxt));
        })//find
    })//done
    .fail(()=>{
        console.log(textStatus);
    })//fail

})


// ４）大エリアを選択して小エリアを取得
$('#jaranlargearea').on('change',(event)=>{
    const selectLargearea = $('#jaranlargearea').val();
    $('#jaransmallarea').empty();
    $('#jaransmallarea').append($('<option>').html("-----小エリアを選択してください-----").val(0));

    $.ajax({
        type:'GET',
        data:{
            l_area:selectLargearea
        },
        url:'./php/04_ih12a26.php',
        chache:false
    })
    .done((data)=>{
        $(data).find('SmallArea').each((index,element)=>{
            const cdTxt = $(element).attr('cd');
            const nameTxt = $(element).attr('name');

            $('#jaransmallarea').append($('<option>').html(nameTxt).val(cdTxt));
        })//find
    })//done
    .fail(()=>{
        console.log(textStatus);
    })//fail

})

// ５）小エリアを選択してホテル情報を取得し、ホテルの情報を画面に表示する
$('#jaransmallarea').on('change',(event)=>{
    $("#hotelInfo").empty();


    const selectSmallarea = $('#jaransmallarea').val();
    console.log(selectSmallarea);
    $.ajax({
        type:'GET',
        data:{
            s_area:selectSmallarea
        },
        url:'./php/04_ih12a26.php',
        chache:false
    })

    .done((data,type) => {
        console.log(data);
        
        $(data).find('Hotel').each(function(){
            const HotelName = $(this).find('HotelName').text();
            const HotelAddress = $(this).find('HotelAddress').text();
            const HotelDetailURL = $(this).find('HotelDetailURL').text();
            const PictureURL = 'src="' + $(this).find('PictureURL').text() + '" ';
            const HotelCatchCopy = $(this).find('HotelCatchCopy').text();
            const HotelCaption = $(this).find('HotelCaption').text();

            
            $("#hotelInfo").append(  
                '<div class="hotellist"><div class="inner"><h2>' + HotelName + "</h2>" + 
                '<h3>' + HotelCatchCopy + '</h3>' + 
                '<p>' + HotelCaption + '</p>' + 
                '<div class="img"><img ' + PictureURL + "onerror=" + '"this.src=' + "'img/white.png';" + '"' + '></img></div><br>' + 
                "<p id='address'>" + HotelAddress + "</p>" +
                '<a href="' + HotelDetailURL + '" target="_blank">オフィシャルサイト</a>' +
                "</div></div>"
            );
        });
    })
    .fail((XMLHttpRequest, textStatus, errorThrown) => {
        $('#hotelInfo').text(textStatus);
        console.log(textStatus);
    })
    .always((XMLHttpRequest, textStatus) => {
        // $('#output').text(textStatus);
        console.log(textStatus);
    });

});
//#hotelInfo内のdivがクリックされたら

$(document).on('click','.hotellist',function(){
    console.log('click');
    let place = $(this).find('h2').text();
    console.log(place);

    let image = $(this).find('img').attr('src');
    console.log(image);

    let url = $(this).find('a').attr('href');
    console.log(url);

    let inputText = $(this).find('#address').text();

    // ジオコードオブジェクト作製
    let geocoder = new google.maps.Geocoder();
    // ジオコードオブジェクトにgeocodeメソッドを実行
    geocoder.geocode({'address':inputText},
    function(results,status){
        // 条件にて緯度経度取得処理を行う
        if(status == 'OK'){
            let latlng = results[0].geometry.location;
            map.setCenter(latlng);
            // マーカー
            let marker = new google.maps.Marker({
                position:latlng,//表示する緯度・経度
                animation:google.maps.Animation.DROP,
                map:map,//表示するマップオブジェクト
                icon:{
                    url: './img/10357.png',
                    scaledSize : new google.maps.Size(20, 25)
                },
                
            })

            marker.addListener("click", toggleBounce);

            function toggleBounce() {
                if (marker.getAnimation() !== null) {
                  marker.setAnimation(null);
                } else {
                  marker.setAnimation(google.maps.Animation.BOUNCE);
                }
              }

            // 情報ウィンドウ(吹き出しオブジェクトを作る)
            let infoWindow = new google.maps.InfoWindow({
                content:'<div class="sample">'
                            +'<h2>'+place+'</h2>'
                            +'<img src="'+image+'">'
                            +'<br>'
                            +'<a href="'+url+'">'+place+'</a>'
                        +'</div>'//吹き出しで表示するコンテンツを決める
            });


            // infoWindow.open(map, marker);
            // markerにクリックイベントを設定
            marker.addListener('click',function(){
                
                infoWindow.open(map, marker);
            });

        }
    })
})