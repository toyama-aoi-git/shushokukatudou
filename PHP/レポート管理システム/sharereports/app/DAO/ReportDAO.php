<?php

namespace App\DAO;

use PDO;
use App\Entity\Report;

class ReportDAO
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

    /**
     * 全部門情報検索。
     *
     * @return array
     *  全部門情報が格納された連想配列。キーは部門番号、値はDeptエンティティオブジェクト。
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM reports ORDER BY rp_date DESC";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $reportList = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $rpDate = $row["rp_date"];
            $rpTimeFrom = $row["rp_time_from"];
            $rpTimeTo = $row["rp_time_to"];
            $rpContent = $row["rp_content"];
            $rpCreatedAt = $row["rp_created_at"];
            $reportcateId = $row["reportcate_id"];
            $userId = $row["user_id"];

            $report = new Report();
            $report->setId($id);
            $report->setRpDate($rpDate);
            $report->setRpTimeFrom($rpTimeFrom);
            $report->setRpTimeTo($rpTimeTo);
            $report->setRpContent($rpContent);
            $report->setRpCreatedAt($rpCreatedAt);
            $report->setReportcateId($reportcateId);
            $report->setUserId($userId);
            $reportList[$id] = $report;
        }
        return $reportList;
    }
    //リスト表示用に作業内容を10文字にカット
    public function findAllContent10(): array
    {
        $sql = "SELECT * FROM reports ORDER BY rp_date DESC";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        $reportList = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $rpDate = $row["rp_date"];
            $rpTimeFrom = $row["rp_time_from"];
            $rpTimeTo = $row["rp_time_to"];
            $rpContent = $row["rp_content"];
            //先頭10文字にカット
            //改行を検出し、切り出す長さを取得
            $trimNum = 10 + (substr_count($rpContent, "\n") * 2);
            $rpContent = mb_substr($rpContent, 0, $trimNum);


            //管理用フラグ
            // $flg = 1;
            // $trimN = 0;
            // while ($flg == 1) {
            //     if (mb_strlen($rpContent) > 10) {
            //         // 10文字で切り取る
            //         $trimrpContent = mb_substr($rpContent, 0, (10 + $trimN));
            //         // 改行の数を数える
            //         // 改行があるか
            //         $i = substr_count($trimrpContent, "\n");
            //         if ($i != 0) {
            //             $trimN = $i * 2;
            //             $flg = 1;
            //         } else {
            //             $flg = 0;
            //         }
            //     }
            // }

            // 改行全部取る



            $rpCreatedAt = $row["rp_created_at"];
            $reportcateId = $row["reportcate_id"];
            $userId = $row["user_id"];

            $report = new Report();
            $report->setId($id);
            $report->setRpDate($rpDate);
            $report->setRpTimeFrom($rpTimeFrom);
            $report->setRpTimeTo($rpTimeTo);
            $report->setRpContent($rpContent);
            $report->setRpCreatedAt($rpCreatedAt);
            $report->setReportcateId($reportcateId);
            $report->setUserId($userId);
            $reportList[$id] = $report;
        }
        return $reportList;
    }

    //レポートIDによる検索
    public function findByReportId(int $reportId): ?report
    {
        $sql = "SELECT * FROM reports WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $reportId, PDO::PARAM_INT);
        $result = $stmt->execute();
        $report = null;
        if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $rpDate = $row["rp_date"];
            $rpTimeFrom = $row["rp_time_from"];
            $rpTimeTo = $row["rp_time_to"];
            $rpContent = $row["rp_content"];
            $rpCreatedAt = $row["rp_created_at"];
            $reportcateId = $row["reportcate_id"];
            $userId = $row["user_id"];

            $report = new Report();
            $report->setId($id);
            $report->setRpDate($rpDate);
            $report->setRpTimeFrom($rpTimeFrom);
            $report->setRpTimeTo($rpTimeTo);
            $report->setRpContent($rpContent);
            $report->setRpCreatedAt($rpCreatedAt);
            $report->setReportcateId($reportcateId);
            $report->setUserId($userId);
        }
        return $report;
    }

    //更新処理
    public function update(Report $report): bool
    {
        $sqlUpdate = "UPDATE Reports SET rp_date = :rp_date, rp_time_from = :rp_time_from, rp_time_to = :rp_time_to,rp_content = :rp_content,reportcate_id = :reportcate_id WHERE id = :id";
        $stmt = $this->db->prepare($sqlUpdate);
        $stmt->bindValue(":rp_date", $report->getRpDate(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_time_from", $report->getrpTimeFrom(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_time_to", $report->getrpTimeTo(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_content", $report->getRpContent(), PDO::PARAM_STR);
        $stmt->bindValue(":reportcate_id", $report->getReportcateId(), PDO::PARAM_INT);
        $stmt->bindValue(":id", $report->getId(), PDO::PARAM_INT);

        $result = $stmt->execute();
        return $result;
    }

    //追加処理
    public function insert(Report $report): int
    {
        $sqlInsert = "INSERT INTO reports (rp_date, rp_time_from, rp_time_to, rp_content, rp_created_at, reportcate_id, user_id) VALUES (:rp_date, :rp_time_from, :rp_time_to, :rp_content, :rp_created_at, :reportcate_id, :user_id)";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(":rp_date", $report->getRpDate(), PDO::PARAM_INT);
        $stmt->bindValue(":rp_time_from", $report->getrpTimeFrom(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_time_to", $report->getrpTimeTo(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_content", $report->getRpContent(), PDO::PARAM_STR);
        $stmt->bindValue(":rp_created_at", $report->getRpCreatedAt(), PDO::PARAM_STR);
        $stmt->bindValue(":reportcate_id", $report->getReportcateId(), PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $report->getUserId(), PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result) {
            $usId = $this->db->lastInsertId();
        } else {
            $usId = -1;
        }
        return $usId;
    }

    //削除処理
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM reports WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }
}
