<?php

/**
 * PH35 サンプル4 無名関数 Src03/09
 * 可変長引数。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=useVariableLengthArgs.php
 * フォルダ=/ph35/closure/
 */

//  $nameが配列化される
function helloToMany(string ...$names): void
{
    foreach ($names as $name) {
        $msg = $name . "さん、こんにちは!<br>";
        print($msg);
    }
}

helloToMany("しんちゃん", "たけちゃん", "けんちゃん", "こうちゃん");
