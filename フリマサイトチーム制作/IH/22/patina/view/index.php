<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/img_size_index.css">
    <link rel="stylesheet" type="text/css" href="css/carousel.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <title>TOP画面</title>
</head>
<body>
    <main>
        <div class="top-line">
            <div class="top">
                <a href="./index.php?product=">出品履歴</a>
                <a href="./index.php?past=">購入履歴</a>
            </div>
        </div>


        <div class="topics">
            <div class="h2">
                <h2>おすすめの商品</h2>
            </div>
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <!-- ここをループで回す -->
                    <?php foreach($list as $key => $value): ?>
                    <div class="swiper-slide">
                        <div class="cflex">
                            <div class="imgList">
                                <div class="imgbox">
                                    <div class="imgbox2">
                                    <a href="./index.php?label=<?php echo $list[$key]['id']; ?>"><img src="./img/<?php echo $list[$key]['img_url']; ?>" width="200" alt="商品の写真"></a>
                                    </div>
                                    <p>¥<?php echo $list[$key]['price']; ?></p>
                                </div>
                                <p><?php echo $list[$key]['name']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <div class="topics">
            <div class="h2">
                <h2>おすすめのジャンル</h2>
            </div>
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="cflex">
                            <div class="imgList">
                                <div class="imgbox">
                                    <div class="imgbox2">
                                        <a href="./index.php?genre=7"><img src="./img/jenre/elegant.jpg" width="200" alt="ジャンルの写真"></a>
                                    </div>
                                </div>
                                <p>エレガント</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="cflex">
                                <div class="imgList">
                                    <div class="imgbox">
                                        <div class="imgbox2">
                                        <a href="./index.php?genre=4"><img src="./img/jenre/midcentury.jpg" width="200" alt="ジャンルの写真"></a>
                                        </div>
                                    </div>
                                    <p>ミッドセンチュリー</p>
                                </div>
                            </div>
                        </div>
                    <div class="swiper-slide">
                        <div class="cflex">
                                <div class="imgList">
                                    <div class="imgbox">
                                    <div class="imgbox2">
                                        <a href="./index.php?genre=5"><img src="./img/jenre/junk.jpg" width="200" alt="ジャンルの写真"></a>
                                    </div>
                                    </div>
                                    <p>ジャンク</p>
                                </div>
                            </div>
                        </div>
                    <div class="swiper-slide">
                        <div class="cflex">
                                <div class="imgList">
                                    <div class="imgbox">
                                    <div class="imgbox2">
                                        <a href="./index.php?genre=10"><img src="./img/jenre/etc.jpg" width="200" alt="ジャンルの写真"></a>
                                    </div>
                                    </div>
                                    <p>その他</p>
                                </div>
                            </div>
                        </div>
                    </div>
               
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                
            </div>
        <!-- </div>
            <a href="./index.php">ポイントショップはこちら</a>
        </div> -->
    </main>
</body>
<script src="js/carousel.js"></script>
</html>






