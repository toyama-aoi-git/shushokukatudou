<?php

/**
 * PH35 サンプル3 マスタテーブル管理 Src04/12
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=Conf.php
 * フォルダ=/scottadmin/classes/
 */

/**
 * 定数クラス
 */

//  PDOの際に必要な情報をこのファイルで一括管理する！
class Conf
{
   // 定数の宣言は、大文字のスネーク記法で行う(_で区切る)
   const DB_DNS = "mysql:host=localhost;dbname=ph35scott;charset=utf8";
   const DB_USERNAME = "scott";
   const DB_PASSWORD = "tiger";
}
