<?php

/**
 * PH35 サンプル4 無名関数 Src08/09
 * 組み込み関数のコールバックと自作関数。
 *
 * @author Shinzo SAITO
 *
 * ファイル名=useArrayWalkAndFunc.php
 * フォルダ=/ph35/closure/
 */

/**
 * 関数を自作するときは、コールバックされる元の関数のリファレンスの引数部を参照する
 */
function showCube($side, $key): void
{
    $cube = $side * $side * $side;
    print("1辺が" . $side . "の立方体の体積: " . $cube . "<br>");
}

$sides = [1.5, 2.4, 3.3];
/**
 * 「array_walk」:引数の配列に引数の関数を適用し改変する
 */
array_walk($sides, "showCube");
