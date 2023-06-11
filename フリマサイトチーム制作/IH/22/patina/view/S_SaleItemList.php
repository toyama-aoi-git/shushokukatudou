<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" type="text/css" href="./css/headerFooter.css">
    <link rel="stylesheet" href="./css/img_size.css">
    <title>検索商品一覧画面</title>
</head>
<body>
    <main>
    <h1>商品検索結果</h1>
    <form action="./S_SaleItemList.php" method="post">
    <select name="genre">
        <option value="1">ナチュラル</option>
        <option value="2">和モダン</option>
        <option value="3">レトロ</option>
        <option value="4">ミッドセンチュリー</option>
        <option value="5">ジャンク</option>
        <option value="6">ミックススタイル</option>
        <option value="7">エレガント</option>
        <option value="8">シャビーシック</option>
        <option value="9">大正ロマン</option>
        <option value="10">その他</option>           
    </select>
    <select name="kinds">
        <option value="1">チェア</option>
        <option value="2">ソファー</option>
        <option value="3">ベンチ</option>
        <option value="4">食器棚</option>
        <option value="5">収納棚</option>
        <option value="6">本棚</option>
        <option value="7">ドロワー</option>
        <option value="8">サイドボード</option>
        <option value="9">ローボード</option>
        <option value="10">デスク</option>
        <option value="11">カウンター</option>
        <option value="12">ガラスケース</option>
        <option value="13">ベッド</option>            
        <option value="14">ダイニングテーブル</option>
        <option value="15">センター・サイドテーブル</option>
        <option value="16">和筆筒</option>
        <option value="17">建具</option>
    </select>
    <button type="submit">検索</button>
    </form>
            <div class="cflex">
                <?php foreach($list as $key => $value): ?>

                        <div class="imgList">
                            <div class="imgbox">
                                <div class="imgbox2">
                                <a href="./S_SaleItemList.php?id=<?php echo $list[$key]['id']; ?>"><img src="./img/<?php echo $list[$key]['img_url']; ?>" alt="商品の写真" width="200"></a>
                                </div>
                                <p>¥<?php echo $list[$key]['price']; ?></p>
                            </div>
                            <p><?php echo $list[$key]['name']; ?></p>
                        </div>      
                    
                <?php endforeach; ?>
            </div>
    </main> 
</body>
<script src="js/func.js"></script>
</html>



