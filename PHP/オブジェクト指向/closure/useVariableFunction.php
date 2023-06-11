<?php

/**
 * PH35 サンプル4 無名関数 Src05/09
 * 可変関数。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=useVariableFunction.php
 * フォルダ=/ph35/closure/
 */



function hello(string $name): void
{
    $msg = $name . "さん、こんにちは！<br>";
    print($msg);
}

/**
 * 可変関数
 * →関数名を変数名にした上で利用できる
 */
$funcName = "hello";
$funcName("しんちゃん");
