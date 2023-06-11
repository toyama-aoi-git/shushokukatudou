<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/destyle.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="css/headerFooter.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <div>
                <a href="./index.php">
                    <img src="img/logo.png" class="logo" alt="">
                </a>
            </div>
            <form action="./index.php" method="GET" class="search_container">
                <input type="text" name="searchWord" placeholder="なにをお探しですか？">
                <button type="submit" name="search" id="search"><img src="img/icon/search.png" width="20" alt="" class="search"></button>
            </form>
            <div class="headerA">
                <form action="./Display.php" method="post">
                    <!-- <a href="./index.php">マイページ</a> -->
                    <!-- <button type="submit" name="logout" value="logout" class="logout">ログアウト</button> -->
                    <button type="submit" name="logout" value="Exhibit" class="Exhibit">出品</button>
                </form>
                
            </div>

        </header>
    </body>
</html>



