<?php

/**
 * PH35 サンプル3 マスタテーブル管理 Src06/12
 * 部門情報リスト表示。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=showDeptList.php
 * フォルダ=/scottadmin/public/dept/
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Dept.php");

$deptList = [];
try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

    $sql = "SELECT * FROM depts ORDER BY dp_no";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row["id"];
        $dpNo = $row["dp_no"];
        $dpName = $row["dp_name"];
        $dpLoc = $row["dp_loc"];

        $dept = new Dept();
        $dept->setId($id);
        $dept->setDpNo($dpNo);
        $dept->setDpName($dpName);
        $dept->setDpLoc($dpLoc);
        $deptList[$id] = $dept;
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
    <title>部門情報リスト | ScottAdmin Sample</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>部門情報リスト</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li>部門情報リスト</li>
        </ul>
    </nav>
    <section>
        <p>
            新規登録は<a href="/dept/goDeptAdd.php">こちら</a>から
        </p>
    </section>
    <section>
        <table>
            <thead>
                <tr>
                    <th>部門ID</th>
                    <th>部門番号</th>
                    <th>部門名</th>
                    <th>所在地</th>
                    <th colspan="2">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($deptList)) {
                ?>
                    <tr>
                        <td colspan="5">該当部門は存在しません。</td>
                    </tr>
                    <?php
                } else {
                    foreach ($deptList as $dept) {
                    ?>
                        <tr>
                            <td><?= $dept->getId() ?></td>
                            <td><?= $dept->getDpNo() ?></td>
                            <td><?= $dept->getDpName() ?></td>
                            <td><?= $dept->getDpLoc() ?></td>
                            <td>
                                <form action="/dept/prepareDeptEdit.php" method="post">
                                    <input type="hidden" id="editDeptId<?= $dept->getId() ?>" name="editDeptId" value="<?= $dept->getId() ?>">
                                    <button type="submit">編集</button>
                                </form>
                            </td>
                            <td>
                                <form action="/dept/confirmDeptDelete.php" method="post">
                                    <input type="hidden" id="deleteDeptId<?= $dept->getId() ?>" name="deleteDeptId" value="<?= $dept->getId() ?>">
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>