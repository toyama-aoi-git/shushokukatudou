$('#btnid').on('click',function(){
    $.ajax({
      type:"GET",
      async:false,
      url:"https://weather.tsukumijima.net/api/forecast",
      data:{
        city:$('input[name="code"]').val()
      }
    }).done(function(data){

        // データを配列に変換
        // let array_data = JSON.stringify(data);
        // let title = array_data["title"]
        let text =  "";
        text += "<h2>" + data["title"] + "</h2>";
        text += "<p>" + data["description"]["text"] + "</p>";
      $("#output1").html(text);
    //   データを文字に変換してまるごと表示する
    //   $("#output1").text(JSON.stringify(data));
    }).fail(function (xhr){
    }).always(function (xhr){
    })
  })

