<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Emp.php");

$addEmNo = $_POST["addEmNo"];
$addEmName = $_POST["addEmName"];
$addEmJob = $_POST["addEmJob"];
$addEmMgr = $_POST["addEmMgr"];
$addEmHiredate = $_POST["addEmHiredate"];
$addEmSal = $_POST["addEmSal"];
$addDeptId = $_POST["addDeptId"];
// 全角スペースを半角スペースに変換(文字列)
$addEmName = str_replace("　", " ", $addEmName);
$addEmJob = str_replace("　", " ", $addEmJob);
$addEmHiredate = str_replace("　", " ", $addEmHiredate);

// 「trim」:文字列の先頭および末尾にある空白を取り除いてくれる(全角スペースは取り除いてくれないから、上で半角に変換)
// 今回の場合、DB格納の際や、エラーで入力画面に戻ったときに空白を無くしてくれる。
//また、フォームに空白だけを入力した場合に空判定をするためにも使う。(判定はPHPで行う)
$addEmName = trim($addEmName);
$addEmJob = trim($addEmJob);
$addEmHiredate = trim($addEmHiredate);

$emp = new Emp();
$emp->setEmNo($addEmNo);
$emp->setEmName($addEmName);
$emp->setEmJob($addEmJob);
$emp->setEmMgr($addEmMgr);
$emp->setEmHiredate($addEmHiredate);
$emp->setEmSal($addEmSal);
$emp->setDeptId($addDeptId);

// バリデーションのエラー文を格納する配列(エラー文をためまくって、配列が空かどうかでチェック)
// 配列にすることで、様々なエラー文を表示できる
$validationMsgs = [];
// 未入力チェック
if (empty($addEmNo)) {
    $validationMsgs[] = "従業員番号の入力は必須です。";
}
if (empty($addEmName)) {
    $validationMsgs[] = "従業員名の入力は必須です。";
}
if (empty($addEmJob)) {
    $validationMsgs[] = "役職の入力は必須です。";
}
if (empty($addEmMgr) && ($addEmMgr != 0)) { //ここやばい
    $validationMsgs[] = "上司番号の入力は必須です。";
}
if (empty($addEmHiredate)) {
    $validationMsgs[] = "雇用日の入力は必須です。";
}
if (empty($addEmSal) && ($addEmSal != 0)) {
    $validationMsgs[] = "給与の入力は必須です。";
}
if (empty($addDeptId)) {
    $validationMsgs[] = "所属部門IDの入力は必須です。";
}
if (($addEmNo < 1000) || (9999 < $addEmNo)) {
    $validationMsgs[] = "入力した従業員番号が不正な値です。";
}
try {
    // バリデーションチェック

    // Conf.phpで作った定数を呼び出している
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

    $sqlSelect = "SELECT COUNT(*) count FROM emps WHERE em_no = :em_no";
    // オートインクリメントを使うから、insert文にIDがない
    $sqlInsert = "INSERT INTO emps (em_no, em_name, em_job, em_mgr, em_hiredate, em_sal, dept_id) VALUES (:em_no, :em_name, :em_job, :em_mgr, :em_hiredate, :em_sal, :dept_id)";

    $stmt = $db->prepare($sqlSelect);
    $stmt->bindValue(":em_no", $emp->getEmNo(), PDO::PARAM_INT);
    // オートインクリメントの時は、ここで初めて主キーが確定する
    $result = $stmt->execute();
    $count = 1;
    if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $count = $row["count"];
    }
    if ($count > 0) {
        $validationMsgs[] = "その従業員番号はすでに使われています。別のものを指定してください。";
    }

    if (empty($validationMsgs)) {
        $stmt = $db->prepare($sqlInsert);
        $stmt->bindValue(":em_no", $emp->getEmNo(), PDO::PARAM_INT);
        $stmt->bindValue(":em_name", $emp->getEmName(), PDO::PARAM_STR);
        $stmt->bindValue(":em_job", $emp->getEmJob(), PDO::PARAM_STR);
        $stmt->bindValue(":em_mgr", $emp->getEmMgr(), PDO::PARAM_INT);
        $stmt->bindValue(":em_hiredate", $emp->getEmHiredate(), PDO::PARAM_STR);
        $stmt->bindValue(":em_sal", $emp->getEmSal(), PDO::PARAM_INT);
        $stmt->bindValue(":dept_id", $emp->getDeptId(), PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result) {
            // INSERTされた主キーを取得する
            $emId = $db->lastInsertId();
        } else {
            $_SESSION["errorMsg"] = "情報登録に失敗しました。もう一度はじめからやり直してください。";
        }
    } else {
        /**
         * 元の入力値(「serialize」:セッションに格納できるように変換する。
         * 今回の場合は、$deptがオブジェクトなのでデフォルトではセッションに格納できない)
         */
        $_SESSION["emp"] = serialize($emp);
        // バリデーションのエラー文配列をセッションにセット
        $_SESSION["validationMsgs"] = $validationMsgs;
    }
} catch (PDOException $ex) {
    // 本来はエラーの内容をログに保存する必要がある。(Monolog)
    // 今回の場合だと、エラーが出た段階で下のヘッダー関数をコメント化し、var_dumpの内容を表示するようにする（応急処置）
    var_dump($ex);
    $_SESSION["errorMsg"] = "DB接続に失敗しました。";
} finally {
    $db = null;
}

if (isset($_SESSION["errorMsg"])) {
    header("Location: /error.php");
    exit;
} elseif (!empty($validationMsgs)) {
    // バリデーションでエラーが発生しているので、入力画面を表示するファイルにリダイレクトする(header)。
    header("Location: /emp/goEmpAdd.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Shinzo SAITO">
    <title>従業員情報追加完了</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>

<body>
    <h1>従業員情報追加完了</h1>
    <nav id="breadcrumbs">
        <ul>
            <li><a href="/">TOP</a></li>
            <li><a href="/emp/showEmpList.php">従業員リスト</a></li>
            <li>従業員情報追加</li>
            <li>従業員情報追加完了</li>
        </ul>
    </nav>
    <section>
        <p>
            以下の従業員情報を登録しました。
        </p>
        <dl>
            <dt>ID(自動生成)</dt>
            <dd><?= $emId ?></dd>
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