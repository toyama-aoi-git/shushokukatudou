<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Emp.php");

$empList = [];
try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

    $sql = "SELECT * FROM emps ORDER BY em_no";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row["id"];
        $emNo = $row["em_no"];
        $emName = $row["em_name"];
        $emJob = $row["em_job"];
        $emMgr = $row["em_mgr"];
        $emHiredate = $row["em_hiredate"];
        $emSal = $row["em_sal"];
        $deptId = $row["dept_id"];

        $emp = new Emp();
        $emp->setId($id);
        $emp->setEmNo($emNo);
        $emp->setEmName($emName);
        $emp->setEmJob($emJob);
        $emp->setEmMgr($emMgr);
        $emp->setEmHiredate($emHiredate);
        $emp->setEmSal($emSal);
        $emp->setDeptId($deptId);
        $empList[$id] = $emp;
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
    <title>従業員情報リスト</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>従業員情報リスト</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li>従業員情報リスト</li>
        </ul>
    </nav>
    <section>
        <p>
            新規登録は<a href="/emp/goEmpAdd.php">こちら</a>から
        </p>
    </section>
    <section>
        <table>
            <thead>
                <tr>
                    <th>従業員ID</th>
                    <th>従業員番号</th>
                    <th>従業員名</th>
                    <th>役職</th>
                    <th>上司番号</th>
                    <th>雇用日</th>
                    <th>給与</th>
                    <th>所属部門ID</th>
                    <th colspan="2">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($empList)) {
                ?>
                    <tr>
                        <td colspan="10">該当部門は存在しません。</td>
                    </tr>
                    <?php
                } else {
                    foreach ($empList as $emp) {
                    ?>
                        <tr>
                            <td><?= $emp->getId() ?></td>
                            <td><?= $emp->getEmNo() ?></td>
                            <td><?= $emp->getEmName() ?></td>
                            <td><?= $emp->getEmJob() ?></td>
                            <td><?= $emp->getEmMgr() ?></td>
                            <td><?= $emp->getEmHiredate() ?></td>
                            <td><?= $emp->getEmSal() ?></td>
                            <td><?= $emp->getDeptId() ?></td>
                            <td>
                                <form action="/emp/prepareEmpEdit.php" method="post">
                                    <input type="hidden" id="editEmpId<?= $emp->getId() ?>" name="editEmpId" value="<?= $emp->getId() ?>">
                                    <button type="submit">編集</button>
                                </form>
                            </td>
                            <td>
                                <form action="/emp/confirmEmpDelete.php" method="post">
                                    <input type="hidden" id="deleteEmpId<?= $emp->getId() ?>" name="deleteEmpId" value="<?= $emp->getId() ?>">
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