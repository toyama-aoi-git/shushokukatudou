<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/img_size.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/headerFooter.css">
    <link rel="stylesheet" type="text/css" href="./css/ProductList.css">
    <link rel="stylesheet" type="text/css" href="./css/img_size.css">
<title>Document</title>
</head>
<body>
    <main>
        <h1>出品している商品</h1>
        <div id="back">
            <a href="./index.php"><span></span>戻る</a>
        </div>
        <div class="cflex">

            <?php foreach($list as $key => $value): ?>

                <div class="imgList">
                    <div class="imgbox">
                        <div class="imgbox2">
                        <a href="./S_SaleItemList.php"><img src="./img/<?php echo $list[$key]['img_url']; ?>" alt="商品の写真" width="200"></a>
                        </div>
                        <p class="price">¥<?php echo $list[$key]['price']; ?></p>
                    </div>
                    <p class="display_name"><?php echo $list[$key]['name']; ?></p>
                </div>

            <?php endforeach; ?>

        </div>
    </main>
</body>
</html>