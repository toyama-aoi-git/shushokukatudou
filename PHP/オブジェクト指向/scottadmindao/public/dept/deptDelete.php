<?php

/**
 * PH35 サンプル5 マスタテーブル管理DAO版 Src13/13
 * 部門情報削除。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=deptDelete.php
 * フォルダ=/scottadmindao/public/dept/
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Dept.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/dao/DeptDAO.php");

$deleteDeptId = $_POST["deleteDeptId"];

try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);
    $deptDAO = new DeptDAO($db);
    $result = $deptDAO->delete($deleteDeptId);
    if (!$result) {
        $_SESSION["errorMsg"] = "情報削除に失敗しました。もう一度はじめからやり直してください。";
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
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>部門情報削除完了 | ScottAdminDAO Sample</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>部門情報削除完了</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/dept/showDeptList.php">部門リスト</a></li>
            <li>部門情報削除確認</li>
            <li>部門情報削除完了</li>
        </ul>
    </nav>
    <section>
        <p>
            部門ID<?= $deleteDeptId ?>の情報を削除しました。
        </p>
        <p>
            部門リストに<a href="/dept/showDeptList.php">戻る</a>
        </p>
    </section>
</body>

</html>