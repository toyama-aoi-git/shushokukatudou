<?php

/**
 * PH35 サンプル4 無名関数 Src09/09
 * 無名関数。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=useClosure.php
 * フォルダ=/ph35/closure/
 */
$sides = [1.5, 2.4, 3.3];

//「ueseArrayWalkAndFunc.php」のshowCube関数を、コード内で何度も利用しない場合
// →直接ぶっこんで使い捨てにする
// →無名関数(クロージャー)
// JSは引数でコールバック定義が多く使い捨ての場合が多いので、無名関数が多用される。(無名関数よりかはアロー関数の方がメジャー)
array_walk($sides, function ($side, $key): void {
    $cube = $side * $side * $side;
    print("1辺が" . $side . "の立方体の体積: " . $cube . "<br>");
});
