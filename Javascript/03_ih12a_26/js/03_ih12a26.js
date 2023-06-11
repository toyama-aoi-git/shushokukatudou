'use struct'

// 起動したら地域を取得する
$.ajax({
    type:'GET',
    url:'./php/03_ih12a26.php',
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

//地域を選択して都道府県を取得
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
        url:'./php/03_ih12a26.php',
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


//都道府県を選択して大エリアを取得
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
        url:'./php/03_ih12a26.php',
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

//大エリアを選択して小エリアを取得
$('#jaranlargearea').on('change',(event)=>{
    const selectLargearea = $('#jaranlargearea').val();
    $('#jaransmallarea').empty();
    $('#jaransmallarea').append($('<option>').html("-----小エリアを選択してください-----").val(0));

    $.ajax({
        type:'GET',
        data:{
            l_area:selectLargearea
        },
        url:'./php/03_ih12a26.php',
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

// ホテル情報表示

$('#jaransmallarea').on('change',(event)=>{
    $("#output").empty();


    const selectSmallarea = $('#jaransmallarea').val();
    console.log(selectSmallarea);
    $.ajax({
        type:'GET',
        data:{
            s_area:selectSmallarea
        },
        url:'./php/03_ih12a26.php',
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

            
            $("#output").append(
                
                '<div class="output_wrap"><div class="article"><h2>' + HotelName + "</h2>" + 
                '<h3>' + HotelCatchCopy + '</h3>' + 
                '<p>' + HotelCaption + '</p>' + 
                '<div class="img"><img ' + PictureURL + "onerror=" + '"this.src=' + "'img/white.png';" + '"' + '></img></div><br>' + 
                "<p>" + HotelAddress + "</p></div>" +
                '<a href="' + HotelDetailURL + '" target="_blank">オフィシャルサイト</a>' +
                "</div>"
            );
        });
    })
    .fail((XMLHttpRequest, textStatus, errorThrown) => {
        $('#output').text(textStatus);
        console.log(textStatus);
    })
    .always((XMLHttpRequest, textStatus) => {
        // $('#output').text(textStatus);
        console.log(textStatus);
    });

});