<?php

namespace App\Http\Controllers;

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//読み込み
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entity\Report;
use App\Entity\User;
use App\DAO\ReportDAO;
use App\DAO\UserDAO;
use App\DAO\ReportcateDAO;
use App\Exceptions\DataAccessException;
use App\Http\Controllers\Controller;

// 追加
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * reportsテーブルへのデータ操作クラス。
 */

class ReportController extends Controller
{
    /**
     * レポートリスト画面表示処理。
     */

    /**
     * if,elseの分岐が無くなった（ログインチェックがない）
     *→ログインチェックをミドルウェアに分離した！
     *→ミドルウェア：リクエスト処理の前後に処理を挿入できる仕組み。（よく使う）
     *→「app→Http→Middleware」の中に作成する
     *
     * 
     */
    public function showList(Request $request)
    {
        $templatePath = "reports.list";
        $assign = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);
        $UserDAO = new UserDAO($db);
        //作業内容の先頭10文字特化ver
        $reportList = $ReportDAO->findAllContent10();
        //報告者名を取ってくるため
        $userList = $UserDAO->findAllUser();

        //報告者IDと報告者名を合体
        foreach ($reportList as $reportId => $report) {
            foreach ($userList as $key => $user) {
                if (($report->getUserId()) == ($user->getId())) {
                    $report->setUserName($user->getUsName());
                }
            }
        }


        //追加
        //インスタンス化
        $coll = collect($reportList);

        $reportList = $this->paginate($coll);


        $assign["reportList"] = $reportList;

        return view($templatePath, $assign);
    }

    // ページネーション
    private function paginate($items, $perPage = 5, $page = null, $options = ['path' => '/reports/showList'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    //詳細画面表示処理
    public function showDetail(Request $request, int $reportId)
    {
        $templatePath = "reports.detail";
        $assign = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);
        $UserDAO = new UserDAO($db);
        $ReportcateDAO = new ReportcateDAO($db);
        $report = $ReportDAO->findByReportId($reportId);
        //ユーザ名とメールアドレスを取ってくる
        $userId = $report->getUserId();
        $user = $UserDAO->findByUserId($userId);
        //作業種名を取ってくる
        $reportcateId = $report->getReportcateId();
        $reportcate = $ReportcateDAO->findByReportcateId($reportcateId);
        $assign["report"] = $report;
        $assign["user"] = $user;
        $assign["reportcate"] = $reportcate;
        return view($templatePath, $assign);
    }

    //編集画面表示処理
    public function prepareEdit(Request $request, int $reportId)
    {
        $templatePath = "reports.edit";
        $assign = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);
        $ReportcateDAO = new ReportcateDAO($db);
        $report = $ReportDAO->findByReportId($reportId);
        //作業種名を全部取ってくる
        $reportcateList = $ReportcateDAO->findName();
        $assign["report"] = $report;
        $assign["reportcateList"] = $reportcateList;
        return view($templatePath, $assign);
    }

    //編集処理
    public function edit(Request $request)
    {
        $templatePath = "reports.edit";
        $isRedirect = false;
        $assign = [];
        $editReportId = $request->input("editReportId");
        $editReportDate = $request->input("editReportDate");
        $editReportTimeFrom = $request->input("editReportTimeFrom");
        $editReportTimeTo = $request->input("editReportTimeTo");
        $editReportcateId = $request->input("editReportcateId");
        $editReportContent = $request->input("editReportContent");

        $report = new Report();
        $report->setId($editReportId);
        $report->setRpDate($editReportDate);
        $report->setrpTimeFrom($editReportTimeFrom);
        $report->setrpTimeTo($editReportTimeTo);
        $report->setReportcateId($editReportcateId);
        $report->setRpContent($editReportContent);
        $validationMsgs = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);
        $ReportDB = $ReportDAO->findByReportId($report->getId());
        if (!empty($ReportDB) && $ReportDB->getId() != $editReportId) {
            $validationMsgs[] =
                "そのレポートIDはすでに使われています。別のものを指定してください。";
        }

        //空文字チェック
        if ($editReportContent == null) {
            $validationMsgs[] = "作業内容を入力してください。";
        }

        //作業時刻の逆転チェック
        //開始時間が終了時刻より遅い場合
        if (!empty($ReportDB) && (strtotime($editReportTimeFrom) > strtotime($editReportTimeTo))) {
            $validationMsgs[] =
                "登録された時刻に誤りがあります。「開始時刻」、「終了時刻」を確認してください。";
        }
        if (empty($validationMsgs)) {
            $result = $ReportDAO->update($report);
            if ($result) {
                $isRedirect = true;
            } else {
                throw new
                    DataAccessException("情報更新に失敗しました。もう一度はじめからやり直してください。");
            }
        } else {
            //エラーがあって編集画面に戻る場合
            $ReportcateDAO = new ReportcateDAO($db);
            //作業種名を全部取ってくる
            $reportcateList = $ReportcateDAO->findName();

            $assign["report"] = $report;
            $assign["reportcateList"] = $reportcateList;
            $assign["validationMsgs"] = $validationMsgs;
        }
        if ($isRedirect) {
            $response = redirect("/reports/showDetail/" . $editReportId)->with(
                "flashMsg",
                "レポート情報を更新しました。"
            );
        } else {
            $response = view($templatePath, $assign);
        }
        return $response;
    }
    /**
     * リスト登録画面表示処理。
     */
    public function goAdd(Request $request)
    {
        $templatePath = "reports.add";
        $assign = [];
        $db = DB::connection()->getPdo();
        $ReportcateDAO = new ReportcateDAO($db);
        //作業種名を全部取ってくる
        $reportcateList = $ReportcateDAO->findName();
        $assign["report"] = new Report();
        $assign["reportcateList"] = $reportcateList;

        return view($templatePath, $assign);
    }
    //登録処理
    public function add(Request $request)
    {
        $templatePath = "reports.add";
        $isRedirect = false;
        $assign = [];
        $addReportDate = $request->input("addReportDate");
        $addReportTimeFrom = $request->input("addReportTimeFrom");
        $addReportTimeTo = $request->input("addReportTimeTo");
        $addReportcateId = $request->input("addReportcateId");
        $addReportContent = $request->input("addReportContent");

        $report = new Report();
        //user_idとして、ログインしているユーザIDを取ってくる
        $session = $request->session();
        $userId = $session->get("id");
        //rp_created_atとして、現在日時を取得
        $datetime = date("Y-m-d H:i:s");
        $report->setRpDate($addReportDate);
        $report->setrpTimeFrom($addReportTimeFrom);
        $report->setrpTimeTo($addReportTimeTo);
        $report->setReportcateId($addReportcateId);
        $report->setRpContent($addReportContent);
        $report->setUserId($userId);
        $report->setRpCreatedAt($datetime);
        $validationMsgs = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);

        //空文字チェック
        if ($addReportContent == null) {
            $validationMsgs[] = "作業内容を入力してください。";
        }

        //作業時刻の逆転チェック
        //開始時間が終了時刻より遅い場合
        if (strtotime($addReportTimeFrom) > strtotime($addReportTimeTo)) {
            $validationMsgs[] = "登録された時刻に誤りがあります。「開始時刻」、「終了時刻」を確認してください。";
        }
        if (empty($validationMsgs)) {
            $result = $ReportDAO->insert($report);
            if ($result) {
                $isRedirect = true;
            } else {
                throw new
                    DataAccessException("情報更新に失敗しました。もう一度はじめからやり直してください。");
            }
        } else {
            //エラーがあって編集画面に戻る場合
            $ReportcateDAO = new ReportcateDAO($db);
            //作業種名を全部取ってくる
            $reportcateList = $ReportcateDAO->findName();

            $assign["report"] = $report;
            $assign["reportcateList"] = $reportcateList;
            $assign["validationMsgs"] = $validationMsgs;
        }
        if ($isRedirect) {
            $response = redirect("/reports/showList")->with(
                "flashMsg",
                "レポート情報を追加しました。"
            );
        } else {
            $response = view($templatePath, $assign);
        }
        return $response;
    }

    //削除画面表示処理
    public function confirmDelete(Request $request, int $reportId)
    {
        $templatePath = "reports.confirmDelete";
        $assign = [];
        $db = DB::connection()->getPdo();
        $ReportDAO = new ReportDAO($db);
        $report = $ReportDAO->findByReportId($reportId);
        if (empty($report)) {
            throw new DataAccessException("レポート情報の取得に失敗しました。");
        } else {
            $UserDAO = new UserDAO($db);
            $user = $UserDAO->findByUserId($report->getUserId());
            $assign["report"] = $report;
            $assign["user"] = $user;
        }
        return view($templatePath, $assign);
    }

    //削除処理
    public function delete(Request $request)
    {
        $deleteReportId = $request->input("deleteReportId");
        $db = DB::connection()->getPdo();
        $reportDAO = new ReportDAO($db);
        $result = $reportDAO->delete($deleteReportId);
        if (!$result) {
            throw new
                DataAccessException("情報削除に失敗しました。もう一度はじめからやり直してください。");
        }
        $response = redirect("/reports/showList")->with(
            "flashMsg",
            "レポートID" . $deleteReportId . "のレポート情報を削除しました。"
        );
        return $response;
    }
}
