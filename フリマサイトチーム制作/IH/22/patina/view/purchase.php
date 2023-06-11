<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/headerFooter.css">
    <link rel="stylesheet" type="text/css" href="./css/purchase.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">

    <title>購入画面</title>
</head>
<body>
    
    <main>
    <h1>購入内容の確認</h1>
    <!-- 確認 -->
    <div class="wrap">
        <div class="left">
            <img src="././img/<?php echo $list[0]['img_url']; ?>" width="300">
            <div class="explanation">
                <p>商品名：<label><?php echo $list[0]['name']; ?></label></p>
                
                <p>商品代金：￥<label for=""><?php echo $list[0]['price']; ?></label></p>
                
            </div>

            <div class="pay">
                <h3>支払方法</h3>
                <p>クレジットカード</p>
                <p>手数料：100</p>
            </div>

            <div class="delivery">
                <h3>配送先</h3>
                <form action="purshase.php" method="post">
                    <label for="">氏名：</label><input type="text" placeholder="春　太郎"><br><br>
                    <label for="">郵便番号：</label><input type="text" placeholder="5300001"><br><br>
                    <label for="">住所：</label><input type="text" placeholder="大阪府大阪市北区梅田３丁目３−１"><br><br>
                </form>
            </div>
        </div>
        <div class="right">
            <!-- 最終決済 -->
            <div class="lastPay">
                <p>商品代金：￥<label for=""><?php echo $list[0]['price']; ?></label></p>

                <p>決済手数料：￥100</p>
                <p>配送手数料：￥500</p>

                <p>支払金額：￥<label for=""><?php echo $list[0]['price'] + 600; ?></label></p>

                <p>支払方法：クレジットカード</p>
            </div>

            <div class="purchase">
                <a href="./purchase.php?flag=<?php echo $list[0]['id']; ?>" label="purchase">購入する</a>
            </div>
        </div>
    </div>
</main>
</body>
</html>