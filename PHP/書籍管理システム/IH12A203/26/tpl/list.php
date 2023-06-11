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
    <title>単行本一覧</title>
</head>
<body>


    <h1>単行本一覧</h1>
    <div class="center">
        <?php echo isset($complete)?$complete:''; ?>
    </div>

    <div class="center">
        <form action="./list.php" method="post">
            <input type="text"name="word">
            <button id="submit" class="btn btn-primary" type="submit" name="state" value="serch">検索</button>
        </form>
        <?php if(isset($_POST['word'])){ ?>
            <p><?php echo count($list); ?>件のデータが見つかりました。</p>
        <?php } ?>
    </div>

    <table class="table table-striped table-hover w-75 mx-auto">
        <th>タイトル</th>
        <th>巻数</th>
        <th>価格<form action="./list.php" method="post"><button id="submit"class="btn btn-outline-primary" type="submit" name="state" value="ASC">昇順</button><button id="submit" class="btn btn-outline-primary" type="submit" name="state" value="DESC">降順</button></form></th>
        <th>発売日</th>
        <th>購入日</th>
        <th>画像</th>
        <th>変更・削除</th>
        <?php for($i = 0;$i < count($list);$i++){ ?>
        <tr>
                <td><!-- タイトル -->
                    <?php echo $list[$i]['title'] ;?>
                </td>
                <td><!-- 巻数 -->
                    <?php echo $list[$i]['volume'] ;?>巻
                </td>
                <td>
                    <?php echo number_format($list[$i]['price']) ;?>円
                </td>
                <td>
                    <?php echo date('Y年m月d日',strtotime($list[$i]['release_date'])) ;?>
                </td>
                <td>
                    <?php echo $list[$i]['purchase_date'] !='' ?date('Y年m月d日',strtotime($list[$i]['purchase_date'])):'' ;?>
                </td>  
                 <!--画像  -->
                <td>
                    <img src="<?php echo DIR_IMG . $list[$i]['id'] ?>.jpg" alt="" width="100">
                </td>
                <td>
                    <!-- aタグで値を送信 -->
                    <a class="btn btn-outline-primary" href="./update.php?<?php echo $list[$i]['id']; ?>">変更</a><span> </span><a class="btn btn-outline-primary" href="./delete.php?<?php echo $list[$i]['id']; ?>">削除</a>
                </td>        
        </tr>
        <?php } ?>
    </table>
    
    <div class="center">
        <a class="btn btn-primary" href="./insert.php">単行本を登録する</a>
    </div>

    <div class="center">
        <form action="./list.php" method="post">
            <button id="submit" class="btn btn-primary" type="submit" name="state" value="download">CSVファイルでダウンロード</button>
        </form>
    </div>
</body>
<script src="js/func.js"></script>
</html>




