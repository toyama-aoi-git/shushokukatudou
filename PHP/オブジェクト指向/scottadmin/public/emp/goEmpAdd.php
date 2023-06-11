<?php


//  「$_SERVER」：サーバの情報が格納されている標準配列、「DOCUMENT_ROOT」でドキュメントルートフォルダパスが取得できるので、
// publicからの相対パスと組み合わせるとGOOD!!require_onceで活用できる！
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Emp.php");

// Deptエンティティを作製
$emp = new Emp();
// セッション内にデータがあれば
if (isset($_SESSION["emp"])) {
    // セッションを使い入力フォームに値を入れなおす
    $emp = $_SESSION["emp"];
    $emp = unserialize($emp);
    // セッション内のデータを削除(残ったままだと、次にこのページに来た時にもエラー文が表示されてしまう)
    unset($_SESSION["emp"]);
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
    <title>従業員情報追加</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>従業員情報追加</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/emp/showEmpList.php">従業員リスト</a></li>
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
        <form action="/emp/empAdd.php" method="post" class="box">
            <label for="addEmNo">
                従業員番号&nbsp;<span class="required">必須</span>
                <!-- 「required」は、入力必須項目(スペースはすり抜けるので、サーバーサイドでのバリデーションが必要) -->
                <!-- DBを参照する必要があるバリデーションはサーバーサイドで実装する -->
                <!-- 「min」：最小値、「max」：最大値、「step」：指定した数値刻みのフォームが作れる -->
                <input type="number" min="1000" max="9999" step="1" id="addEmNo" name="addEmNo" value="<?= $emp->getEmNo() ?>" required>
            </label><br>
            <label for="addEmName">
                従業員名&nbsp;<span class="required">必須</span>
                <input type="text" id="addEmName" name="addEmName" value="<?= $emp->getEmName() ?>" required>
            </label><br>
            <label for="addEmJob">
                役職&nbsp;<span class="required">必須</span>
                <input type="text" id="addEmJob" name="addEmJob" value="<?= $emp->getEmJob() ?>" required>
            </label><br>
            <label for="addEmMgr">
                上司番号&nbsp;<span class="required">必須</span>
                <input type="number" id="addEmMgr" name="addEmMgr" value="<?= $emp->getEmMgr() ?>" required>
            </label><br>
            <label for="addEmHiredate">
                雇用日&nbsp;<span class="required">必須</span>
                <input type="text" id="addEmHiredate" name="addEmHiredate" value="<?= $emp->getEmHiredate() ?>" required>
            </label><br>
            <label for="addEmSal">
                給与&nbsp;<span class="required">必須</span>
                <input type="number" min="0" id="addEmSal" name="addEmSal" value="<?= $emp->getEmSal() ?>" required>
            </label><br>
            <label for="addDeptId">
                所属部門ID&nbsp;<span class="required">必須</span>
                <input type="number" id="addDeptId" name="addDeptId" value="<?= $emp->getDeptId() ?>" required>
            </label><br>

            <button type="submit">登録</button>
        </form>
    </section>
</body>

</html>