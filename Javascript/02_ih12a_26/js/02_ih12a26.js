'use struct'


$('#button').click(function(){
    $("#url-error").remove();
})

$('form').validate({
    rules:{
        url:{
            required:true
        }
    },
    messages:{
        url:{
            required: "ラジオボタンを押してください"
        }
    },errorPlacement:(error,element)=>{
        if(element.attr("name")==="url"){
            error.insertAfter("#radio_error");
        }else{
            error.insertAfter(element);
        }
    },submitHandler:(form)=> {
        // form.submit();
        send_ajax();
    }
});




function send_ajax(){

    let value = $("input[name='url']:checked").val();

    
    $("#output").empty();


    $.ajax({
        url:'./php/02_ih12a26.php?url='+value,
        type:'GET',
    })
    
    .done((data,type) => {
        console.log(data);
        
        $(data).find('item').each(function(){
            const titleTxt = $(this).find('title').text();
            const pubdate = $(this).find('pubDate').text();
            const link = $(this).find('link').text();
            const img = 'src="' + $(this).find('image').text() + '" ';
            const date = new Date(pubdate);
            pubdateTxt = date.getFullYear() + "年"
                + (date.getMonth() + 1) + "月"
                + date.getDate() + "日"
                + date.getHours() + "時"
                + date.getMinutes() + "分"
                + date.getSeconds() + "秒";
    
            // console.log(titleTxt);
            // console.log(pubdateTxt);
            // console.log(img);

            
            $("#output").append(
                
                '<div class="output_wrap"><div class="article"><h2>' + titleTxt + "</h2>" + 
                '<a href="' + link + '">記事へ(別タブで表示します)</a>' +
                "<p>" + pubdateTxt + "</p></div>" +
                '<div class="img"><img ' + img + "onerror=" + '"this.src=' + "'img/white.png';" + '"' + '></img></div><br>' + 
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
    
};




