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
    <title>単行本情報削除</title>
</head>
<body>
    <h1>単行本情報削除</h1>

    <table class="table table-striped table-hover w-25 mx-auto">
        <tr>
            <td>タイトル</td>
            <td><?php echo $main_data['title']; ?></td>
        </tr>
        <tr>
            <td>巻数</td>
            <td><?php echo $main_data['volume'] ; ?>巻</td>
        </tr>
        <tr>
            <form action="./list.php">
                <td>価格</td>
            </form>
            <td><?php echo number_format($main_data['price']); ?>円</td>
        </tr>
        <tr>
            <td>発売日</td>
            <td><?php echo date('Y年m月d日',strtotime($main_data['release_date'])) ; ?></td>
        </tr>
        <tr>
            <td>購入日</td>
            <td><?php echo $main_data['purchase_date'] == '-'?'-':date('Y年m月d日',strtotime($main_data['purchase_date'])) ; ?></td>
        </tr>
        <tr>
            <td>画像</td>
            <td><img src="<?php echo DIR_IMG . $main_data['id'] ?>.jpg" alt="" width="100"></td>
        </tr>
    </table>

    <form method="post" action="./delete.php?<?php echo $main_data['id']; ?>">
        <div class="center">
            <button id="submit" type="submit" class="btn btn-outline-info" name="state" value="insert">単行本の情報を削除する</button>
        </div>
    </form>


</body>
</html>