<?php

// エンティティ呼び出し
require_once("Department.php");

$dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
$username = "ph35sqlusr";
$password = "hogehoge";

// 今回の変わる部分
$keyword = 'Sales';

$departmentList = [];
try {
    $db = new PDO($dsn, $username, $password);

    $sql = "SELECT * FROM departments WHERE department_name LIKE :depart";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":depart", "%" . $keyword . "%", PDO::PARAM_STR);
    $result = $stmt->execute();

    while ($row = $stmt->fetch()) {
        $departmentId = $row["department_id"];
        $departmentName = $row["department_name"];
        $managerId = $row["manager_id"];
        $locationId = $row["location_id"];

        $department = new Department();
        $department->setDepartmentId($departmentId);
        $department->setDepartmentName($departmentName);
        $department->setManagerId($managerId);
        $department->setLocationId($locationId);

        // 連想配列に入れておくことで、エンティティが新たにnewされても大丈夫なようにする(キーはorderId)。
        // →最終的に、結果表が丸ごと格納された連想配列が出来上がる！
        // →これを「O-Rマッピング」と呼ぶ！(言語とDBのテーブルを行き来しやすくする。)
        $departmentList[$departmentId] = $department;
    }
} catch (PDOException $ex) {
    print("DB接続に失敗しました。<br>");
    var_dump($ex);
} finally {
    $db = null;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PH35 課題1 「エンティティの確認」</title>
    <link rel="stylesheet" type="text/css" href="../css/destyle.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <h1>PH35 課題1 「エンティティの確認」</h1>
    <?php
    if (empty($departmentList)) {
    ?>
        <p>該当データはありません。</p>
    <?php
    } else {
    ?>
        <table>
            <thead>
                <tr>
                    <th>部門ID</th>
                    <th>部門名</th>
                    <th>マネージャーID</th>
                    <th>ロケーションID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $orderId = キー,$order = エンティティが入る。
                foreach ($departmentList as $departmentId => $department) {
                ?>
                    <tr>
                        <td><?= $department->getDepartmentId() ?></td>
                        <td><?= $department->getDepartmentName() ?></td>
                        <td><?= $department->getManagerId() ?></td>
                        <td><?= $department->getLocationId() ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</body>

</html>