<?php

namespace App\Http\Controllers;

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

class UserController extends Controller
{
    /**
     * ユーザ登録画面表示処理。
     */
    public function goUserAdd(Request $request)
    {
        $templatePath = "users.userAdd";
        $assign = [];
        $assign["user"] = new User();

        return view($templatePath, $assign);
    }
    //登録処理
    public function userAdd(Request $request)
    {
        $templatePath = "users.userAdd";
        $isRedirect = false;
        $assign = [];
        $addUserMail = $request->input("addUserMail");
        $addUserName = $request->input("addUserName");
        $addUserPassword = bcrypt($request->input("addUserPassword"));
        $addUsAuth = $request->input("addUsAuth");

        $user = new User();

        $user->setUsMail($addUserMail);
        $user->setUsName($addUserName);
        $user->setUsPassword($addUserPassword);
        $user->setUsAuth($addUsAuth);

        $validationMsgs = [];
        $db = DB::connection()->getPdo();
        $UserDAO = new UserDAO($db);

        //空文字チェック
        if ($addUserMail == null) {
            $validationMsgs[] = "メールアドレスを入力してください。";
        }
        if ($addUserName == null) {
            $validationMsgs[] = "名前を入力してください。";
        }
        if ($addUserPassword == null) {
            $validationMsgs[] = "パスワードを入力してください。";
        }

        // メールアドレスチェック
        if (!filter_var($addUserMail, FILTER_VALIDATE_EMAIL)) {
            $validationMsgs[] = "そのメールアドレスは利用できません。";
        }

        if (empty($validationMsgs)) {
            $result = $UserDAO->insert($user);
            if ($result) {
                $isRedirect = true;
            } else {
                throw new
                    DataAccessException("情報更新に失敗しました。もう一度はじめからやり直してください。");
            }
        } else {
            $assign["user"] = $user;
            $assign["validationMsgs"] = $validationMsgs;
        }
        if ($isRedirect) {
            $response = redirect("/users/showUserList")->with(
                "flashMsg",
                "ユーザ情報を追加しました。"
            );
        } else {
            $response = view($templatePath, $assign);
        }
        return $response;
    }

    public function showUserList(Request $request)
    {
        $templatePath = "users.userList";
        $assign = [];
        $db = DB::connection()->getPdo();
        $UserDAO = new UserDAO($db);
        $userList = $UserDAO->findAll();

        //追加
        //インスタンス化
        $coll = collect($userList);

        $userList = $this->paginate($coll);


        $assign["userList"] = $userList;

        return view($templatePath, $assign);
    }

    // ページネーション
    private function paginate($items, $perPage = 5, $page = null, $options = ['path' => '/users/showUserList'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    //編集画面表示処理
    public function prepareUserEdit(Request $request, int $userId)
    {
        $templatePath = "users.userEdit";
        $assign = [];
        $db = DB::connection()->getPdo();
        $UserDAO = new UserDAO($db);
        $user = $UserDAO->findByUserId($userId);
        $assign["user"] = $user;
        return view($templatePath, $assign);
    }

    //編集処理
    public function userEdit(Request $request)
    {
        $templatePath = "users.userEdit";
        $isRedirect = false;
        $assign = [];
        $editUserId = $request->input("editUserId");
        $editUserMail = $request->input("editUserMail");
        $editUserName = $request->input("editUserName");
        $editUserPassword = bcrypt($request->input("editUserPassword"));
        $editUsAuth = $request->input("editUsAuth");

        $user = new User();
        $user->setId($editUserId);
        $user->setUsMail($editUserMail);
        $user->setUsName($editUserName);
        $user->setUsPassword($editUserPassword);
        $user->setUsAuth($editUsAuth);
        $validationMsgs = [];
        $db = DB::connection()->getPdo();
        $UserDAO = new UserDAO($db);
        $UserDB = $UserDAO->findByUserId($user->getId());
        if (!empty($UserDB) && $UserDB->getId() != $editUserId) {
            $validationMsgs[] =
                "そのレポートIDはすでに使われています。別のものを指定してください。";
        }

        //空文字チェック(メール)
        if ($editUserMail == null) {
            $validationMsgs[] = "メールアドレスを入力してください。";
        }

        // メールアドレスチェック
        if (!filter_var($editUserMail, FILTER_VALIDATE_EMAIL)) {
            $validationMsgs[] = "そのメールアドレスは利用できません。";
        }

        //空文字チェック（名前）
        if ($editUserName == null) {
            $validationMsgs[] = "名前を入力してください。";
        }

        //空文字チェック（パスワード）
        if ($editUserPassword == null) {
            $validationMsgs[] = "パスワードを入力してください。";
        }

        if (empty($validationMsgs)) {
            $result = $UserDAO->update($user);
            if ($result) {
                $isRedirect = true;
            } else {
                throw new
                    DataAccessException("情報更新に失敗しました。もう一度はじめからやり直してください。");
            }
        } else {
            //エラーがあって編集画面に戻る場合

            $assign["user"] = $user;
            $assign["validationMsgs"] = $validationMsgs;
        }
        if ($isRedirect) {
            $response = redirect("/users/showUserList")->with(
                "flashMsg",
                "レポート情報を更新しました。"
            );
        } else {
            $response = view($templatePath, $assign);
        }
        return $response;
    }
}
