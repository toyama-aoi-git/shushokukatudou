<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><!-- jQuery読み込み -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>単行本情報登録</title>
</head>
<body>
    <h1>単行本情報登録</h1>
    <div class="center">
        <form method="post" class="form" action="./insert.php" enctype="multipart/form-data">
            <p><span>タイトル</span><input type="text" name="title" value="<?php echo isset($_POST['title'])?$_POST['title']:'';?>"><span><?php echo isset($err_msg['title'])?$err_msg['title']:''; ?></span></p>
            <p><span>巻数</span><input type="text" name="volume" value="<?php echo isset($_POST['volume'])?$_POST['volume']:'';?>"><span>巻</span><span><?php echo isset($err_msg['volume'])?$err_msg['volume']:''; ?></span></p>
            <p><span>価格</span><input type="text" name="price" value="<?php echo isset($_POST['price'])?$_POST['price']:'';?>"><span>円</span><span><?php echo isset($err_msg['price'])?$err_msg['price']:''; ?></span></p>
            <p><span>発売日</span><input type="text" name="release_date" value="<?php echo isset($_POST['release_date'])?$_POST['release_date']:'';?>" placeholder="例）20200101"><span><?php echo isset($err_msg['release_date'])?$err_msg['release_date']:''; ?></span></p>
            <p><span>購入日</span><input type="text" name="purchase_date" value="<?php echo isset($_POST['purchase_date'])?$_POST['purchase_date']:'';?>" placeholder="例）20200101"><span><?php echo isset($err_msg['purchase_date'])?$err_msg['purchase_date']:''; ?></span><br></p>
            <p><input type="file"  name="img" placeholder="画像"></p>
            <button id="submit" type="submit" class="btn btn-outline-info" name="state" value="insert">単行本を登録する</button>
        </form>
    </div>

</body>
</html>