<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Emp.php");

$editEmId = $_POST["editEmId"];
$editEmNo = $_POST["editEmNo"];
$editEmName = $_POST["editEmName"];
$editEmJob = $_POST["editEmJob"];
$editEmMgr = $_POST["editEmMgr"];
$editEmHiredate = $_POST["editEmHiredate"];
$editEmSal = $_POST["editEmSal"];
$editDeptId = $_POST["editDeptId"];

$editEmName = str_replace("　", " ", $editEmName);
$editEmJob = str_replace("　", " ", $editEmJob);
$editEmHiredate = str_replace("　", " ", $editEmHiredate);

// 「trim」:文字列の先頭および末尾にある空白を取り除いてくれる(全角スペースは取り除いてくれないから、上で半角に変換)
// 今回の場合、DB格納の際や、エラーで入力画面に戻ったときに空白を無くしてくれる。
//また、フォームに空白だけを入力した場合に空判定をするためにも使う。(判定はPHPで行う)
$editEmName = trim($editEmName);
$editEmJob = trim($editEmJob);
$editEmHiredate = trim($editEmHiredate);

$emp = new Emp();
$emp->setId($editEmId);
$emp->setEmNo($editEmNo);
$emp->setEmName($editEmName);
$emp->setEmJob($editEmJob);
$emp->setEmMgr($editEmMgr);
$emp->setEmHiredate($editEmHiredate);
$emp->setEmSal($editEmSal);
$emp->setDeptId($editDeptId);

// バリデーション
$validationMsgs = [];

if (empty($editEmNo)) {
    $validationMsgs[] = "従業員番号の入力は必須です。";
}
if (empty($editEmName)) {
    $validationMsgs[] = "従業員名の入力は必須です。";
}
if (empty($editEmJob)) {
    $validationMsgs[] = "役職の入力は必須です。";
}
if (empty($editEmMgr) && ($editEmMgr != 0)) {
    $validationMsgs[] = "上司番号の入力は必須です。";
}
if (empty($editEmHiredate)) {
    $validationMsgs[] = "雇用日の入力は必須です。";
}
if (empty($editEmSal) && ($editEmSal != 0)) {
    $validationMsgs[] = "給与の入力は必須です。";
}
if (empty($editDeptId)) {
    $validationMsgs[] = "所属部門IDの入力は必須です。";
}
if (($editEmNo < 1000) || (9999 < $editEmNo)) {
    $validationMsgs[] = "入力した従業員番号が不正な値です。";
}


try {
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);
    $sqlSelect = "SELECT id FROM emps WHERE em_no = :em_no";
    $sqlUpdate = "UPDATE emps SET em_no = :em_no, em_name = :em_name, em_job = :em_job, em_mgr = :em_mgr, em_hiredate = :em_hiredate, em_sal = :em_sal, dept_id = :dept_id WHERE id = :id";
    $stmt = $db->prepare($sqlSelect);
    $stmt->bindValue(":em_no", $emp->getEmNo(), PDO::PARAM_INT);
    $result = $stmt->execute();
    $idInDB = 0;
    if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $idInDB = $row["id"];
    }
    if ($idInDB > 0 && $idInDB != $editEmId) {
        $validationMsgs[] = "その従業員番号はすでに使われています。別のものを指定してください。";
    }
    if (empty($validationMsgs)) {
        $stmt = $db->prepare($sqlUpdate);
        $stmt->bindValue(":em_no", $emp->getEmNo(), PDO::PARAM_INT);
        $stmt->bindValue(":em_name", $emp->getEmName(), PDO::PARAM_STR);
        $stmt->bindValue(":em_job", $emp->getEmJob(), PDO::PARAM_STR);
        $stmt->bindValue(":em_mgr", $emp->getEmMgr(), PDO::PARAM_INT);
        $stmt->bindValue(":em_hiredate", $emp->getEmHiredate(), PDO::PARAM_STR);
        $stmt->bindValue(":em_sal", $emp->getEmSal(), PDO::PARAM_INT);
        $stmt->bindValue(":dept_id", $emp->getDeptId(), PDO::PARAM_INT);
        $stmt->bindValue(":id", $emp->getId(), PDO::PARAM_INT);
        $result = $stmt->execute();
        if (!$result) {
            $_SESSION["errorMsg"] = "情報更新に失敗しました。もう一度はじめからやり直してください。";
        }
    } else {
        $_SESSION["emp"] = serialize($emp);
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
    header("Location: /emp/prepareEmpEdit.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shinzo SAITO">
    <title>従業員情報編集完了</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>従業員情報編集完了</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/emp/showEmpList.php">部門リスト</a></li>
            <li>従業員情報編集</li>
            <li>従業員情報編集完了</li>
        </ul>
    </nav>
    <section>
        <p>
            以下の従業員情報を更新しました。
        </p>
        <dl>
            <dt>ID(自動生成)</dt>
            <dd><?= $emp->getId() ?></dd>
            <dt>従業員番号</dt>
            <dd><?= $emp->getEmNo() ?></dd>
            <dt>従業員名</dt>
            <dd><?= $emp->getEmName() ?></dd>
            <dt>役職</dt>
            <dd><?= $emp->getEmJob() ?></dd>
            <dt>上司番号</dt>
            <dd><?= $emp->getEmMgr() ?></dd>
            <dt>雇用日</dt>
            <dd><?= $emp->getEmHiredate() ?></dd>
            <dt>給与</dt>
            <dd><?= $emp->getEmSal() ?></dd>
            <dt>所属部門ID</dt>
            <dd><?= $emp->getDeptId() ?></dd>
        </dl>
        <p>
            従業員リストに<a href="/emp/showEmpList.php">戻る</a>
        </p>
    </section>
</body>

</html>