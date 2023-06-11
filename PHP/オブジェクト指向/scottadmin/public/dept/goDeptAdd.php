<?php

/**
 * PH35 サンプル3 マスタテーブル管理 Src07/12
 * 部門情報登録画面表示。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=goDeptAdd.php
 * フォルダ=/scottadmin/public/dept/
 */

//  「$_SERVER」：サーバの情報が格納されている標準配列、「DOCUMENT_ROOT」でドキュメントルートフォルダパスが取得できるので、
// publicからの相対パスと組み合わせるとGOOD!!require_onceで活用できる！
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Dept.php");

// Deptエンティティを作製
$dept = new Dept();
// セッション内にデータがあれば
if (isset($_SESSION["dept"])) {
    // セッションを使い入力フォームに値を入れなおす
    $dept = $_SESSION["dept"];
    $dept = unserialize($dept);
    // セッション内のデータを削除(残ったままだと、次にこのページに来た時にもエラー文が表示されてしまう)
    unset($_SESSION["dept"]);
}
// メッセージ配列をnullで用意
$validationMsgs = null;
// データがあれば
if (isset($_SESSION["validationMsgs"])) {
    $validationMsgs = $_SESSION["validationMsgs"];
    // セッション内のデータを削除(残ったままだと、次にこのページに来た時にもエラー文が表示されてしまう)
    unset($_SESSION["validationMsgs"]);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>部門情報追加 | ScottAdmin Sample</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>部門情報追加</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/dept/showDeptList.php">部門リスト</a></li>
            <li>部門情報追加</li>
        </ul>
    </nav>
    <?php
    if (!is_null($validationMsgs)) {
    ?>
        <section id="errorMsg">
            <p>以下のメッセージをご確認ください。</p>
            <ul>
                <?php
                foreach ($validationMsgs as $msg) {
                ?>
                    <li><?= $msg ?></li>
                <?php
                }
                ?>
            </ul>
        </section>
    <?php
    }
    ?>
    <section>
        <p>
            情報を入力し、登録ボタンをクリックしてください。
        </p>
        <form action="/dept/deptAdd.php" method="post" class="box">
            <label for="addDpNo">
                部門番号&nbsp;<span class="required">必須</span>
                <!-- 「required」は、入力必須項目(スペースはすり抜けるので、サーバーサイドでのバリデーションが必要) -->
                <!-- DBを参照する必要があるバリデーションはサーバーサイドで実装する -->
                <!-- 「min」：最小値、「max」：最大値、「step」：指定した数値刻みのフォームが作れる -->
                <input type="number" min="10" max="90" step="10" id="addDpNo" name="addDpNo" value="<?= $dept->getDpNo() ?>" required>
            </label><br>
            <label for="addDpName">
                部門名&nbsp;<span class="required">必須</span>
                <input type="text" id="addDpName" name="addDpName" value="<?= $dept->getDpName() ?>" required>
            </label><br>
            <label for="addDpLoc">
                所在地
                <input type="text" id="addDpLoc" name="addDpLoc" value="<?= $dept->getDpLoc() ?>">
            </label><br>
            <button type="submit">登録</button>
        </form>
    </section>
</body>

</html>