<?php

namespace App\DAO;

use PDO;
use App\Entity\User;

/**
 * usersテーブルへのデータ操作クラス。
 */
class UserDAO
{
    /**
     * @var PDO DB接続オブジェクト
     */
    private PDO $db;
    /**
     * コンストラクタ
     *
     * @param PDO $db DB接続オブジェクト
     */
    public function __construct(PDO $db)
    {
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->db = $db;
    }

    //メールアドレス検索
    public function findByMail(string $mail): ?User
    {
        $sql = "SELECT * FROM users WHERE us_mail = :us_mail";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":us_mail", $mail, PDO::PARAM_STR);
        $result = $stmt->execute();
        $user = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $usMail = $row["us_mail"];
            $usName = $row["us_name"];
            $usPassword = $row["us_password"];
            $usAuth = $row["us_auth"];

            $user = new User();
            $user->setId($id);
            $user->setUsMail($usMail);
            $user->setUsName($usName);
            $user->setUsPassword($usPassword);
            $user->setUsAuth($usAuth);
        }
        return $user;
    }

    //ユーザIDによる名前とメールアドレス検索
    public function findByUserId(int $userId): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
        $result = $stmt->execute();
        $user = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $usMail = $row["us_mail"];
            $usName = $row["us_name"];
            $usAuth = $row["us_auth"];

            $user = new User();
            $user->setId($id);
            $user->setUsMail($usMail);
            $user->setUsName($usName);
            $user->setUsAuth($usAuth);
        }
        return $user;
    }

    //全件取得
    public function findAllUser(): array
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        //入れ物
        $userList = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $us_mail = $row["us_mail"];
            $us_name = $row["us_name"];
            $us_password = $row["us_password"];
            $us_auth = $row["us_auth"];

            $user = new User();
            $user->setId($id);
            $user->setUsMail($us_mail);
            $user->setUsName($us_name);
            $user->setUsPassword($us_password);
            $user->setUsAuth($us_auth);
            $userList[$id] = $user;
        }
        return $userList;
    }

    //ユーザ追加を入れる場合ここに入れる
    //追加処理
    public function insert(User $User): int
    {
        $sqlInsert = "INSERT INTO users (us_mail, us_name, us_password, us_auth) VALUES (:us_mail, :us_name, :us_password, :us_auth)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(":us_mail", $User->getUsMail(), PDO::PARAM_STR);
        $stmt->bindValue(":us_name", $User->getUsName(), PDO::PARAM_STR);
        $stmt->bindValue(":us_password", $User->getUsPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":us_auth", $User->getUsAuth(), PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result) {
            $usId = $this->db->lastInsertId();
        } else {
            $usId = -1;
        }
        return $usId;
    }

    // ユーザ情報全件取得
    public function findAll(): array
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $userList = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $usMail = $row["us_mail"];
            $usName = $row["us_name"];
            $usPassword = $row["us_password"];
            $usAuth = $row["us_auth"];

            $user = new User();
            $user->setId($id);
            $user->setUsMail($usMail);
            $user->setUsName($usName);
            $user->setUsPassword($usPassword);
            $user->setUsAuth($usAuth);
            $userList[$id] = $user;
        }
        return $userList;
    }

    //更新処理
    public function update(User $user): bool
    {
        $sqlUpdate = "UPDATE Users SET us_mail = :us_mail, us_name = :us_name, us_password = :us_password,us_auth = :us_auth WHERE id = :id";
        $stmt = $this->db->prepare($sqlUpdate);
        $stmt->bindValue(":us_mail", $user->getUsMail(), PDO::PARAM_STR);
        $stmt->bindValue(":us_name", $user->getUsName(), PDO::PARAM_STR);
        $stmt->bindValue(":us_password", $user->getUsPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":us_auth", $user->getUsAuth(), PDO::PARAM_INT);
        $stmt->bindValue(":id", $user->getId(), PDO::PARAM_INT);

        $result = $stmt->execute();
        return $result;
    }
}
