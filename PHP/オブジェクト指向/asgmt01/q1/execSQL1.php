<?php

$dsn = "mysql:host=localhost;dbname=ph35sql;charset=utf8";
$username = "ph35sqlusr";
$password = "hogehoge";

// 今回のsqlのwhere用
$salary = 10000;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PH35 課題1 「PHP-DBの復習」</title>
    <link rel="stylesheet" type="text/css" href="../css/destyle.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <h1>
        選択したSQL=「SELECT employee_id, first_name, last_name, salary FROM employees WHERE
        salary >= 10000;」
    </h1>
    <table>
        <thead>
            <tr>
                <th>従業員ID</th>
                <th>苗字</th>
                <th>名前</th>
                <th>給料</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $db = new PDO($dsn, $username, $password);

                $sql = "SELECT employee_id,first_name,last_name,salary FROM employees WHERE salary >= :salary";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":salary", $salary, PDO::PARAM_INT);
                $result = $stmt->execute();

                /**
                 * SQL文を実行したら、$stmtには結果表が丸々格納される。
                 * →表から1行分の配列を取得するのがfetch
                 * →それを配列の行数分ループさせたら、全実行結果を取得できる。
                 */
                while ($row = $stmt->fetch()) {
                    $employeeId = $row["employee_id"];
                    $firstName = $row["first_name"];
                    $lastName = $row["last_name"];
                    $salary = $row["salary"];
            ?>
                    <tr>
                        <!-- ＜？＝$a？＞は＜？php　echo $a;?>と同じ意味 -->
                        <td><?= $employeeId ?></td>
                        <td><?= $firstName ?></td>
                        <td><?= $lastName ?></td>
                        <td><?= $salary ?></td>
                    </tr>
            <?php
                }
            } catch (PDOException $ex) {
                print("DB接続に失敗しました。<br>");
                var_dump($ex);
            } finally {
                $db = null;
            }
            ?>
        </tbody>
    </table>
</body>

</html>