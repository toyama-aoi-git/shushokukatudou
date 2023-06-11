<?php

/**
 * PH35 サンプル4 無名関数 Src07/09
 * 組み込み関数のコールバック。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=useArrayMapAndTrim.php
 * フォルダ=/ph35/closure/
 */
// ↓配列の各要素に関して、文字列の前後に半角空白が何個か含まれている点に注意!
$params = [" 齊藤 ", " 新三 ", " プログラマ "];
print("<pre>");
var_dump($params);
print("</pre>");

/**
 * ここではtrim関数をコールバックしてくれている
 * →"trim"は文字列ではなく関数として動いている
 * 「array_map」:引数の配列に引数の関数を実行した新たな配列を返す。
 */
$trimedParams = array_map("trim", $params);
print("<pre>");
var_dump($trimedParams);
print("</pre>");
