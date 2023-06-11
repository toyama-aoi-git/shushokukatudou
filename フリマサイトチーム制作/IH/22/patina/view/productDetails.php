<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./css/destyle.css">
    <link rel="stylesheet" type="text/css" href="./css/img_size.css">
    <link rel="stylesheet" type="text/css" href="./css/headerFooter.css">
    <link rel="stylesheet" type="text/css" href="./css/productDetails.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <title>商品詳細画面</title>
</head>
<body>
    <main>
        <div id="itemlist">
            <div id="imgbox">
                <div id="back">
                    <span></span><a href="./productDetails.php">戻る</a>
                </div>
                <div class="imgbox2">
                <img src="././img/<?php echo $list[0]['img_url']; ?>" width="300">
                </div>
                <p class="iDetail"><?php echo $list[0]['sentence']; ?></p>
            </div>
            <div id="detailbox">
                <h2 class="userName">Las CloveR</h2>
                <label for="">商品名:<p class="itemName"><?php echo $list[0]['name']; ?></p></label>
                <!-- <button>♡いいね</button> -->
                <div id="priceBox">
                    <p class="price">￥<?php echo $list[0]['price']; ?></p>
                    <a href="./productDetails.php?pur=<?php echo $list[0]['id']; ?>">購入手続きへ</a>
                </div>
                <div id="sendDetail">
                    <h2>商品の発送について</h2>
                    <p>まさる堂から倉庫から発送される商品です<br>入金が確認され次第発送されます</p>
                </div>
            </div>
        </div>
    </main>
<!-- <img src="././img/商品アイコン.png"><p>アカウント</p>
<button>フォロー</button>
<img src="././img/商品アイコン.png">
<img src="././img/商品アイコン.png">
<img src="././img/商品アイコン.png">
<img src="././img/商品アイコン.png">
<p>もっと見る</p> -->
</body>
</html>