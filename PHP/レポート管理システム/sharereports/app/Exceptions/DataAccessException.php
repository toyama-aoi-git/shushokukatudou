<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

/**
 * データ処理中に想定外の事態を検知した時に発生させる例外クラス。
 */
class DataAccessException extends Exception
{
    /**
     * 例外発生時に行う画面表示処理。
     *
     * @param Request $request リクエストオブジェクト。
     * @return レスポンスオブジェクト。
     */
    public function render(Request $request)
    {
        /**
         * 例外メッセージを取得
         *（thisはExceptionを指す）
         */
        $errorMsg = $this->getMessage();
        /**
         * テンプレート変数に格納
         */
        $assign["errorMsg"] = $errorMsg;
        /**
         * errorテンプレート画面を表示
         */
        return view("error", $assign);
    }
}
