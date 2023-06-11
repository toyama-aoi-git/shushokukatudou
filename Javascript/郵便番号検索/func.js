// /*
//  * main.js : zipcloudから住所情報を取得する
//  */

// const zipcloudURL = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=";

// // 住所を整形して表示する
// function formatJSON(json){
// 	console.log(json);
// 	// テキストボックスクリア
// 	document.querySelector("#message").textContent = "";
// 	document.querySelector("#results").textContent = "";

// 	if(json.message !== null){	// エラーメッセージ有り
// 		document.querySelector("#message").textContent = json.message;
// 	}
// 	else if(json.results === null){	// 存在しない郵便番号
// 		document.querySelector("#message").textContent = "郵便番号が存在しません";
// 	}
// 	else{	// 取得した住所情報を表示
// 		let table = "";
// 		for(let i=0; i<json.results.length; i++){
//             table += "<div class='card'>"
// 			table += "<table>";
// 			table += "<caption>候補" + (i+1).toString() + "</caption>";
// 			table += "<tr><th>都道府県</th><td>" + json.results[i].address1 + "</td></tr>";
// 			table += "<tr><th>市郡区町村</th><td>" + json.results[i].address2 + "</td></tr>";
// 			table += "<tr><th>住所</th><td>" + json.results[i].address3 + "</td></tr>";
// 			table += "</table>";
//             table += "</div>";
// 		}
// 		document.querySelector("#results").innerHTML = table;
//         // document.querySelector("#results").style.marginTop="0";
// 	}
// }

// // 起動時の処理
// window.addEventListener("load", ()=>{
// 	// 検索ボタンイベント設定
// 	const btnSearch = document.getElementById("btnSearch");

// 	btnSearch.addEventListener("click", ()=>{
// 		const zipcode = document.querySelector("#zipcode").value;	// 入力した郵便番号
// 		const url = zipcloudURL + zipcode + "&limit=100";	// zipcloudのURLに入力した郵便番号を連結
// 															// 注）limit=100のパラメタは取得する住所の最大数
// 															// 　　日本では同一郵便番号で複数の住所が存在する地域がある
// 															// 　　最大は愛知県清須市の〒452-0961が66件であるためlimit=100とした

// 		document.querySelector("#message").textContent = "郵便番号検索中...";
// 		// zipcloudからJSONデータを取得　⇒　取得後formatJSON呼び出し
// 		fetch(url)
// 			.then( response => response.json())
// 			.then( data => formatJSON(data));
// 	})

// });


$(function () {
    //検索ボタンをクリックされたときに実行
    $("#search_btn").click(function () {
        //入力値をセット
        var param = {zipcode: $('#zipcode').val()}
        //zipcloudのAPIのURL
        var send_url = "http://zipcloud.ibsnet.co.jp/api/search";
        $.ajax({
            type: "GET",
            cache: false,
            data: param,
            url: send_url,
            dataType: "jsonp",
            success: function (res) {
                //結果によって処理を振り分ける
                if (res.status == 200) {
                    //処理が成功したとき
                    //該当する住所を表示
                    var html = '';
                    for (var i = 0; i < res.results.length; i++) {
                        var result = res.results[i];
                        console.log(res.results);
                        html += '<div class="card">';
                        html += '<h2>住所' + (i + 1) + '</h2>';
                        html += '<div>都道府県コード：' + result.prefcode + '</div>';
                        html += '<div>都道府県：' + result.address1 + '</div>';
                        html += '<div>市区町村：' + result.address2 + '</div>';
                        html += '<div>町域：' + result.address3 + '</div>';
                        html += '<div>都道府県(カナ)：' + result.kana1 + '</div>';
                        html += '<div>市区町村(カナ)：' + result.kana1 + '</div>';
                        html += '<div>町域(カナ)：' + result.kana1 + '</div>';
                        html += '</div>';
                    }
                    $('#zip_result').html(html);
                } else {
                    //エラーだった時
                    //エラー内容を表示
                    $('#zip_result').html(res.message);
 
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
            }
        });
    });
});
