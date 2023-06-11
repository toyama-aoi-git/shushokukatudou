<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Emp.php");

$emp = new Emp();
$validationMsgs = null;

if (isset($_POST["editEmpId"])) {
    $editEmpId = $_POST["editEmpId"];
    try {
        $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

        $sql = "SELECT * FROM emps WHERE id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $editEmpId, PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        } else {
            $_SESSION["errorMsg"] = "従業員情報の取得に失敗しました。";
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
} else {
    if (isset($_SESSION["emp"])) {
        $emp = $_SESSION["emp"];
        $emp = unserialize($emp);
        unset($_SESSION["emp"]);
    }
    if (isset($_SESSION["validationMsgs"])) {
        $validationMsgs = $_SESSION["validationMsgs"];
        unset($_SESSION["validationMsgs"]);
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>従業員情報編集</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>従業員情報編集</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/emp/showEmpList.php">部門リスト</a></li>
            <li>部門情報編集</li>
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
            情報を入力し、更新ボタンをクリックしてください。
        </p>
        <form action="/emp/empEdit.php" method="post" class="box">
            従業員ID:&nbsp;<?= $emp->getId() ?><br>
            <input type="hidden" name="editEmId" value="<?= $emp->getId() ?>">
            <label for="editEmNo">
                従業員番号&nbsp;<span class="required">必須</span>
                <!-- 「required」は、入力必須項目(スペースはすり抜けるので、サーバーサイドでのバリデーションが必要) -->
                <!-- DBを参照する必要があるバリデーションはサーバーサイドで実装する -->
                <!-- 「min」：最小値、「max」：最大値、「step」：指定した数値刻みのフォームが作れる -->
                <input type="number" min="1000" max="9999" step="1" id="editEmNo" name="editEmNo" value="<?= $emp->getEmNo() ?>" required>
            </label><br>
            <label for="editEmName">
                従業員名&nbsp;<span class="required">必須</span>
                <input type="text" id="editEmName" name="editEmName" value="<?= $emp->getEmName() ?>" required>
            </label><br>
            <label for="editEmJob">
                役職&nbsp;<span class="required">必須</span>
                <input type="text" id="editEmJob" name="editEmJob" value="<?= $emp->getEmJob() ?>" required>
            </label><br>
            <label for="editEmMgr">
                上司番号&nbsp;<span class="required">必須</span>
                <input type="number" id="editEmMgr" name="editEmMgr" value="<?= $emp->getEmMgr() ?>" required>
            </label><br>
            <label for="editEmHiredate">
                雇用日&nbsp;<span class="required">必須</span>
                <input type="text" id="editEmHiredate" name="editEmHiredate" value="<?= $emp->getEmHiredate() ?>" required>
            </label><br>
            <label for="editEmSal">
                給与&nbsp;<span class="required">必須</span>
                <input type="number" min="0" id="editEmSal" name="editEmSal" value="<?= $emp->getEmSal() ?>" required>
            </label><br>
            <label for="editDeptId">
                所属部門ID&nbsp;<span class="required">必須</span>
                <input type="number" id="editDeptId" name="editDeptId" value="<?= $emp->getDeptId() ?>" required>
            </label><br>
            <button type="submit">更新</button>
        </form>
    </section>
</body>

</html>