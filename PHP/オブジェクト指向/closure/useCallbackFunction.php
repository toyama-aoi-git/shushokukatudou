<?php

/**
 * PH35 サンプル4 無名関数 Src06/09
 * コールバック関数。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=useCallbackFunction.php
 * フォルダ=/ph35/closure/
 */
function hello(string $name): string
{
    return $name . "さん、こんにちは!";
}

function goodMorning(string $name): string
{
    return $name . "さん、おはよう!";
}

// 「callable」:引数が関数の名前かチェックしてくれる
function useGreetings(callable $funcName): void
{
    // $funcnameに関数名が入り、関数が実行される
    // →コールバック関数
    $result = $funcName("しんちゃん");
    print($result . "<br>");
}

useGreetings("hello");
useGreetings("goodMorning");
