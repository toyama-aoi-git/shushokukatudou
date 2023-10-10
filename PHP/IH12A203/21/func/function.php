<?php


///エスケープ処理
/**
 * @param string $value エスケープ処理を行いたい文字列 
 * @return エスケープ処理された文字列
 */
function h(string $value): string 
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}


//拡張子を取得する
/**
 * @param string $fileName 拡張子を取得したいファイル名
 */
function getExtension(string $fileName):string
{
    // ファイル名を「.」で分割
    $fileNameArray = explode('.', $fileName);
    // 要素が一つ、つまり拡張子が無いとき
    if (count($fileNameArray) === 1) {
        return '';
    }

    // 一番最後の要素を返す
    return $fileNameArray[count($fileNameArray) - 1];
}


//DBにインサートする
/**
 * @param string $host DBのホスト名
 * @param string $id DBのID
 * @param string $pass DBのパスワード
 * @param string $db 接続するDB
 * @param string $sql インサート文が格納された変数
 * @return インサート文の実行
 */
function insert(
    string $host,
    string $id,
    string $pass,
    string $db,
    string $sql
    ){
    $link = @mysqli_connect($host , $id , $pass , $db);
    if ($link != false){
        mysqli_set_charset($link , 'utf8');
        mysqli_query($link , $sql);
        mysqli_close($link);
    }
}

//DBへ接続する
/**
 * @param string $host DBのホスト名
 * @param string $id DBのID
 * @param string $pass DBのパスワード
 * @param string $db 接続するDB
 * @return DBへの接続
 */
function sql_start(
    string $host,
    string $id,
    string $pass,
    string $db
    ){
    $link = @mysqli_connect($host , $id , $pass , $db);
    if ($link != false){
        mysqli_set_charset($link , 'utf8');
        return $link;
    }
    else{
        return "接続エラー";
    }
}

//SELECT文を実行して値を取得する
/**
 * @param string $host DBのホスト名
 * @param string $id DBのID
 * @param string $pass DBのパスワード
 * @param string $db 接続するDB
 * @param string $sql SELECT文が格納された変数
 * @return SELECT文を実行して取得できた値を格納した配列
 */
function select(
        string $host,
        string $id,
        string $pass,
        string $db,
        string $sql
        ){
    $list = [];
    $link = @mysqli_connect($host , $id , $pass , $db);
    if ($link != false){
        mysqli_set_charset($link , 'utf8');
        $result = mysqli_query($link , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $list[] = $row;
        }
        mysqli_close($link);
        return $list;
    }
    else{
        return "接続エラー";
    }
}


//検索条件に一致するテーブルの列を取り出す
/**
 * @param データベースと接続している状態で使用
 * @param $link データベースの接続子
 * @param string $sql 検索したいテーブルのSELECT文が格納された変数
 * @param string $column 検索したいテーブルのカラム名 
 * @param string $search  検索したい文字列
 * @return $list ヒットした列が格納された配列
 *  */
function sql_search(
    $link,
    string $sql
    ){
        $list = [];
        $result = mysqli_query($link , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $list[] = $row;
        }
        if(empty($list)){
            return false;
        }
        else{
            return $list;
        }
    }


//画像の比率を計算する
/** 
*@param int $width_img  横サイズ
*@param int $height_img 縦サイズ
*@param int $width 計算する横サイズ
*@param int $height 計算する縦サイズ
*@return int 比率で割ったサイズ
**/
function ratio_img(
    int $width_img,
    int $height_img,
    int $width, 
    int $height
    ){

    //画像の比率を計算
    $ratio1 = $width_img / $width;
    $ratio2 = $height_img / $height;

    if($ratio1 < 1 && $ratio2 < 1){ //比率が両方1以下
        $width = $width_img;
        $height = $height_img;
    }
    elseif($ratio1 > $ratio2){//横比率が高い
        $width = $width_img / $ratio1;
        $height = $height_img / $ratio1;
    }
    elseif($ratio1 == $ratio2){//縦横の比率が同じ
        $width = $width_img / $ratio1;
        $height = $height_img / $ratio2;
    }
    elseif($ratio1 < $ratio2){ //横比率が高い
        $width = $width_img / $ratio2;
        $height = $height_img / $ratio2;
    }

    $list=[];
    $list[]  = $width;
    $list[] = $height;
    return $list;
}


/**
 * @param string $file_name aaaa
 * @param string $saveName 保存先のファイルパスと保存名
 * @param string $extension 拡張子
 * @param int $width 保存する横サイズ
 * @param int $height 保存する縦サイズ
 * @param int $img_width 元の横サイズ
 * @param int $img_height 元の縦サイズ
 */
function compression_img(
    string $file_name,
    string $saveName,
    string $extension,
    int $width,
    int $height,
    int $img_width,
    int $img_height
){
    if($extension == "jpg" || $extension == "JPG" || $extension == "jpeg" || $extension == "JPEG"){

        $img_in = imagecreatefromjpeg($file_name);
        $img_out = ImageCreateTruecolor($width,$height);
        
        imagealphablending($img_out,false);
        imagesavealpha($img_out,true);
        
        ImageCopyResampled($img_out,$img_in,0,0,0,0,$width,$height,$img_width,$img_height);
        
        imagejpeg($img_out,$saveName);
    }
    elseif($extension == "PNG" || $extension == "png"){
        $img_in = imagecreatefrompng($file_name);
        $img_out = ImageCreateTruecolor($width,$height);
    
        imagealphablending($img_out,false);
        imagesavealpha($img_out,true);
    
        ImageCopyResampled($img_out,$img_in,0,0,0,0,$width,$height,$img_width,$img_height);
    
        imagepng($img_out,$saveName);
    }
    elseif($extension == "GIF" || $extension == "gif"){
        $img_in = imagecreatefromgif($file_name);
        $img_out = ImageCreateTruecolor($width,$height);
    
        imagealphablending($img_out,false);
        imagesavealpha($img_out,true);
    
        ImageCopyResampled($img_out,$img_in,0,0,0,0,$width,$height,$img_width,$img_height);

        imagegif($img_out,$saveName);
    }
    else{
        return "保存できない拡張子です";
    }
}


?>