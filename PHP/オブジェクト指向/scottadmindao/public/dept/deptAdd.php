<?php

/**
 * PH35 サンプル5 マスタテーブル管理DAO版 Src09/13
 * 部門情報登録。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=deptAdd.php
 * フォルダ=/scottadmindao/public/dept/
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Dept.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/dao/DeptDAO.php");

$addDpNo = $_POST["addDpNo"];
$addDpName = $_POST["addDpName"];
$addDpLoc = $_POST["addDpLoc"];
$addDpName = str_replace(" ", " ", $addDpName);
$addDpLoc = str_replace(" ", " ", $addDpLoc);
$addDpName = trim($addDpName);
$addDpLoc = trim($addDpLoc);

$dept = new Dept();
$dept->setDpNo($addDpNo);
$dept->setDpName($addDpName);
$dept->setDpLoc($addDpLoc);

$validationMsgs = [];

if (empty($addDpName)) {
    $validationMsgs[] = "部門名の入力は必須です。";
}

try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);
    $deptDAO = new DeptDAO($db);
    $deptDB = $deptDAO->findByDpNo($dept->getDpNo());
    if (!empty($deptDB)) {
        $validationMsgs[] = "その部門番号はすでに使われています。別のものを指定してください。";
    }
    if (empty($validationMsgs)) {
        $dpId = $deptDAO->insert($dept);
        if ($dpId === -1) {
            $_SESSION["errorMsg"] =
                "情報登録に失敗しました。もう一度はじめからやり直してください。";
        }
    } else {
        $_SESSION["dept"] = serialize($dept);
        $_SESSION["validationMsgs"] = $validationMsgs;
    }
} catch (PDOException $ex) {
    var_dump($ex);
    $_SESSION["errorMsg"] = "DB接続に失敗しました。";
} finally {
    $db = null;
}

if (isset($_SESSION["errorMsg"])) {
    header("Location: /error.php");
    exit;
} elseif (!empty($validationMsgs)) {
    header("Location: /dept/goDeptAdd.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>部門情報追加完了 | ScottAdminDAO Sample</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>部門情報追加完了</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/dept/showDeptList.php">部門リスト</a></li>
            <li>部門情報追加</li>
            <li>部門情報追加完了</li>
        </ul>
    </nav>
    <section>
        <p>
            以下の部門情報を登録しました。
        </p>
        <dl>
            <dt>ID(自動生成)</dt>
            <dd><?= $dpId ?></dd>
            <dt>部門番号</dt>
            <dd><?= $dept->getDpNo() ?></dd>
            <dt>部門名</dt>
            <dd><?= $dept->getDpName() ?></dd>
            <dt>所在地</dt>
            <dd><?= $dept->getDpLoc() ?></dd>
        </dl>
        <p>
            部門リストに<a href="/dept/showDeptList.php">戻る</a>
        </p>
    </section>
</body>

</html>