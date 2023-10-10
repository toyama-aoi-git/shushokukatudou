<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1>PH24評価課題</h1>

    <p id="user"><img src="<?php echo DIR_IMG . 'user/' . $id . "/" . $fileName;?> " alt=""><?php echo $name;?>さん</p>
    <form action="index.php" method="POST" id="user">
        <button type="submit" name="logout" >ログアウト</button>
    </form>
    <div>
    <table> 
        <?php foreach($news as $val){ ?>
            <tr>
            <td><a href="index.php?news=<?php echo $val['id'];?>"><?php echo $val['title'];?></a></td>
            <td><a href="index.php?news=<?php echo $val['id'];?>"><?php echo $val['created_at'];?></a></td>
            
            </tr>
        <?php } ?>
    </table>
    </div>
        <p>
            <?php echo $page == 0 ? "" : "<a href='./index.php?page=low&num=".$num ."'>" ?>前へ</a>
            <?php for($i=0; $i < $page_list; $i++){ ?>
                <?php echo $page / 5 == $i? "":"<a href='./index.php?list=". $i . "'>"?><?php echo $i + 1;?></a>
            <?php } ?>
            <?php echo $flag == true ? "<a href='./index.php?page=high&num=".$num ."'>" : "" ?>次へ</a>
        </p>
</body>
</html>