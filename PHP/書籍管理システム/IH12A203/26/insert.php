<?php
    session_start();
    $default_link = 'insert.php';
    //config.phpの呼び込み
    require_once '../../config.php';
    require_once './func.php';

    // ボタンを押してこの画面に来るときは
    // $_POST['name']→中身は空（長さ0の文字列）で存在はしている。

    if(isset($_POST['state']) && $_POST['state'] == 'insert'){ //ボタンが押されたかで場合分け

        // タイトル
        if(strlen($_POST['title']) == 0){
            $err_msg['title'] = 'タイトルが未入力です' ;
        }
        else{
            $title = $_POST['title'];  
        }
        
        // 巻数
        if(strlen($_POST['volume']) == 0){
            $err_msg['volume'] = '巻数が未入力です' ;
        }elseif(is_numeric($_POST['volume']) == false){
            $err_msg['volume'] = '数値を入力してください';
            // $p_data['pass'] = $_POST['pass'];
        }else{
            $volume = $_POST['volume'];
        }
    
        //価格
        if(strlen($_POST['price']) == 0){
            $err_msg['price'] = '価格が未入力です' ;
        }elseif(is_numeric($_POST['price']) == false){
            $err_msg['price'] = '数値を入力してください';
        }else{
            $price = $_POST['price'];
        }


        // 発売日
        if(strlen($_POST['release_date']) == 0){
            $err_msg['release_date'] = '発売日が未入力です' ;
        }elseif(is_numeric($_POST['release_date']) == false){
            $err_msg['release_date'] = '数値を入力してください';
        }elseif(strlen($_POST['release_date']) != 8){
            $err_msg['release_date'] = '８桁で入力してください';
        }else{
            $release_date = $_POST['release_date'];
        }


        //check_date

        $release_check = substr_replace($_POST["release_date"],'-',6,0);
        $release_check = substr_replace($release_check,'-',4,0);
        $release_check = explode("-",$release_check);

        if(strlen($_POST['release_date']) != 0){
            if(!checkdate($release_check[1],$release_check[2],$release_check[0])){
                $err_msg['release_date'] = '存在する日付を登録してください';
            }
        }

    if(strlen($_POST['purchase_date']) == 0){
        $purchase_date = 'nothing';
    }elseif(is_numeric($_POST['purchase_date']) == false){
        $err_msg['purchase_date'] = '数値を入力してください';
        $purchase_date = 'err';
    }elseif(strlen($_POST['purchase_date']) != 8){
        $err_msg['purchase_date'] = '８桁で入力してください';
        $purchase_date = 'err';
    }else{
        $purchase_date = $_POST['purchase_date'];
    }
    
    $purchase_check = substr_replace($_POST["purchase_date"],'-',6,0);
    $purchase_check = substr_replace($purchase_check,'-',4,0);
    $purchase_check = explode("-",$purchase_check);

    if(strlen($_POST['purchase_date']) != 0){
        if(!checkdate($purchase_check[1],$purchase_check[2],$purchase_check[0])){
            $err_msg['purchase_date'] = '存在する日付を登録してください';
        }
    }

    // 画像
    $uplode_file = $_FILES['img'];//imgの何をとってくるのかちゃんと指定する
    $img = $uplode_file['name'];
    $size = $uplode_file['size'];
    $temp = explode(".",$img);
    $num = max(array_keys($temp));//最大値の添え字
    $ext = $temp[$num];//拡張子


    if($size == 0){
        $err_msg['img'] = '画像を選択してください。';
    }



    // mysqli_queryの第二引数を変数化（エラー時に確認しやすい）
    //購入日が記述しているかどうか
    if($purchase_date != 'nothing' && $purchase_date != 'err' && !isset($err_msg)){
        $insert_sql = "INSERT INTO m_book (title,volume,price,release_date,purchase_date) VALUES (" . '\'' . $title . '\'' . "," . $volume . "," . $price . "," . '\'' . $release_date . '\'' . ',' . '\'' . $purchase_date . '\'' . ")";
    }elseif($purchase_date == 'nothing' && $purchase_date != 'err' && !isset($err_msg)){
        $insert_sql ="INSERT INTO m_book (title,volume,price,release_date) VALUES (" . '\'' . $title . '\'' . "," . $volume . "," . $price . "," . '\'' . $release_date . '\'' . ")";
    }
    $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    if($link == false){
        //接続失敗の時
        require_once './tpl/connect_err.php';
        exit;
    }elseif($link != false && !isset($err_msg)){
      mysqli_set_charset($link,'utf8');
      mysqli_query($link,$insert_sql);
        //アップロードファイルの移動
    $max_id = mysqli_insert_id($link);
    mysqli_close($link);
    move_uploaded_file($uplode_file['tmp_name'],DIR_IMG . $max_id . '.' . $ext);
      $complete = '登録が完了しました';
      $_SESSION['complete'] = '登録が完了しました';
      header('location:./list.php');
      exit;
    }else{
      require_once './tpl/insert.php';
    }
  }
  
    //viewの表示
    require_once './tpl/insert.php';

?>