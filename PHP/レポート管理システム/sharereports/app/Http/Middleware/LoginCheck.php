<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\NoLoginException;

/**
 * ログインチェックミドルウェアクラス。
→完成したら、kernel.phpで単語登録して、ルーティングにミドルウェアを登録。(web.php)
 */
class LoginCheck
{
    /**
     * ログインチェック処理。
     * ログインされていない状態を検知したらNoLoginExceptionが発生する。
     *
     * @param Request $request リクエストオブジェクト。
     * @param Closure $next コールバック関数。
     * @return レスポンスオブジェクト。
     */

    /**
     * handle(Request $request, Closure $next)は毎回書く
→リクエストオブジェクトとクロージャオブジェクト
     */
    public function handle(Request $request, Closure $next)
    {
        $session = $request->session();
        if (
            !$session->has("loginFlg") || $session->get("loginFlg") == false ||
            !$session->has("id") || !$session->has("name") || !$session->has("auth")
        ) {
            throw new NoLoginException();
        }
        /**
         * ミドルウェアがリクエスト処理の前後どちらに挿入するかを識別
→第二引数の$nextの記述位置で決まる（$next=本来の処理、リクエスト処理）
→「前：挿入したい処理→$next」「後：$next→挿入したい処理」
         */
        $response = $next($request);
        return $response;
    }
}
