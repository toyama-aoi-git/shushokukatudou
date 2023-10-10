<?php

namespace App\DAO;

use PDO;
use App\Entity\Reportcate;

class ReportcateDAO
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

    //作業種類IDによる作業種名検索
    public function findByReportcateId(int $reportcateId): ?Reportcate
    {
        $sql = "SELECT id,rc_name FROM reportcates WHERE id = :reportcateId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":reportcateId", $reportcateId, PDO::PARAM_INT);
        $result = $stmt->execute();
        $reportcate = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rcName = $row["rc_name"];

            $reportcate = new Reportcate();
            $reportcate->setRcName($rcName);
        }
        return $reportcate;
    }

    //作業種名検索
    public function findName(): array
    {
        $sql = "SELECT id,rc_name FROM reportcates";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $reportcate = null;



        //入れ物
        $reportcateList = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $rcName = $row["rc_name"];

            $reportcate = new Reportcate();
            $reportcate->setId($id);
            $reportcate->setRcName($rcName);
            $reportcateList[$id] = $reportcate;
        }
        return $reportcateList;
    }
}
