
$.ajax({
  url: './primary_area.xml',
  type:'GET',
  cache:false
}).done(function(data){
  $(data).find("city").each(
    function(){
      let strid = $(this).attr('id');
      let strtitle = $(this).attr('title');
      $("#citycode").append($('<option>').html(strtitle).val(strid));
    }
  );
  
}).fail({
  function (err){
    console.log(err);
  }
}).always({

})

$('#btnid').on('click',function(){
  $.ajax({
    type:"GET",
    async:false,
    url:"https://weather.tsukumijima.net/api/forecast",
    data:{
      city:$('[name="selectbox"] option:selected').val()
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

