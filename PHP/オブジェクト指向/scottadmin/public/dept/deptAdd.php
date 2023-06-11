<?php

/**
 * PH35 サンプル3 マスタテーブル管理 Src08/12
 * 部門情報登録。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=deptAdd.php
 * フォルダ=/scottadmin/public/dept/
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/Conf.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/../classes/entity/Dept.php");

$addDpNo = $_POST["addDpNo"];
$addDpName = $_POST["addDpName"];
$addDpLoc = $_POST["addDpLoc"];
// 全角スペースを半角スペースに変換
$addDpName = str_replace("　", " ", $addDpName);
$addDpLoc = str_replace("　", " ", $addDpLoc);
// 「trim」:文字列の先頭および末尾にある空白を取り除いてくれる(全角スペースは取り除いてくれないから、上で半角に変換)
// 今回の場合、DB格納の際や、エラーで入力画面に戻ったときに空白を無くしてくれる。
//また、フォームに空白だけを入力した場合に空判定をするためにも使う。(判定はPHPで行う)
$addDpName = trim($addDpName);
$addDpLoc = trim($addDpLoc);


$dept = new Dept();
$dept->setDpNo($addDpNo);
$dept->setDpName($addDpName);
$dept->setDpLoc($addDpLoc);

// バリデーションのエラー文を格納する配列(エラー文をためまくって、配列が空かどうかでチェック)
// 配列にすることで、様々なエラー文を表示できる
$validationMsgs = [];

if (empty($addDpName)) {
    $validationMsgs[] = "部門名の入力は必須です。";
}
try {
    // バリデーションチェック

    // Conf.phpで作った定数を呼び出している
    $db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

    $sqlSelect = "SELECT COUNT(*) count FROM depts WHERE dp_no = :dp_no";
    // オートインクリメントを使うから、insert文にIDがない
    $sqlInsert = "INSERT INTO depts (dp_no, dp_name, dp_loc) VALUES (:dp_no, :dp_name, :dp_loc)";

    $stmt = $db->prepare($sqlSelect);
    $stmt->bindValue(":dp_no", $dept->getDpNo(), PDO::PARAM_INT);
    // オートインクリメントの時は、ここで初めて主キーが確定する
    $result = $stmt->execute();
    $count = 1;
    if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $count = $row["count"];
    }
    if ($count > 0) {
        $validationMsgs[] = "その部門番号はすでに使われています。別のものを指定してください。";
    }

    if (empty($validationMsgs)) {
        $stmt = $db->prepare($sqlInsert);
        $stmt->bindValue(":dp_no", $dept->getDpNo(), PDO::PARAM_INT);
        $stmt->bindValue(":dp_name", $dept->getDpName(), PDO::PARAM_STR);
        $stmt->bindValue(":dp_loc", $dept->getDpLoc(), PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result) {
            // INSERTされた主キーを取得する
            $dpId = $db->lastInsertId();
        } else {
            $_SESSION["errorMsg"] = "情報登録に失敗しました。もう一度はじめからやり直してください。";
        }
    } else {
        /**
         * 元の入力値(「serialize」:セッションに格納できるように変換する。
         * 今回の場合は、$deptがオブジェクトなのでデフォルトではセッションに格納できない)
         */
        $_SESSION["dept"] = serialize($dept);
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
    header("Location: /dept/goDeptAdd.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Shinzo SAITO">
    <title>部門情報追加完了 | ScottAdmin Sample</title>
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