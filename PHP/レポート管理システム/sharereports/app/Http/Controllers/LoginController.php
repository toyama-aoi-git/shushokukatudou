<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DAO\UserDAO;
use App\Http\Controllers\Controller;

/**
 * ログイン・ログアウトに関するコントローラクラス。
 */
class LoginController extends Controller
{
    /**
     * ログイン画面表示処理。
     */
    public function goLogin()
    {
        return view("login");
    }


    /**
     * ログイン処理。
     */
    public function login(Request $request)
    {
        $isRedirect = false;
        $templatePath = "login";
        $assign = [];
        $mail = $request->input("mail");
        $password = $request->input("password");
        $validationMsgs = [];
        if (empty($validationMsgs)) {
            $db = DB::connection()->getPdo();
            $userDAO = new UserDAO($db);
            $user = $userDAO->findByMail($mail);
            if ($user == null) {
                $validationMsgs[] = "存在しないメールアドレスです。正しいメールアドレスを入力してください。";
            } else {
                $userPw = $user->getUsPassword();
                // 入力されたパスワードと、登録されているハッシュ化パスワードを比べる
                if (password_verify($password, $userPw)) {
                    $id = $user->getId();
                    $mail = $user->getUsMail();
                    $name = $user->getUsName();
                    $usAuth = $user->getUsAuth();
                    $session = $request->session();
                    $session->put("loginFlg", true);
                    $session->put("id", $id);
                    $session->put("mail", $mail);
                    $session->put("name", $name);
                    $session->put("auth", $usAuth);
                    $isRedirect = true;
                } else {
                    $validationMsgs[] =
                        "パスワードが違います。正しいパスワードを入力してください。";
                }
            }
        }
        if ($isRedirect) {
            $response = redirect("/reports/showList");
        } else {
            if (!empty($validationMsgs)) {
                $assign["validationMsgs"] = $validationMsgs;
                $assign["mail"] = $mail;
            }
            $response = view("login", $assign);
        }
        return $response;
    }
    /**
     * ログアウト処理。
     */
    public function logout(Request $request)
    {
        $session = $request->session();
        $session->flush();
        $session->regenerate();
        return redirect("/");
    }
}
