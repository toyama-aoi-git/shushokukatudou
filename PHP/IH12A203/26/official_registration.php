<?php
    
    require_once '../../config.php';


    // 始めに飛んできたとき
    if((isset($_GET['id'])) || (isset($_POST['id']))){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }elseif(isset($_POST['id'])){
            $id = $_POST['id'];
        }
        $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
        mysqli_set_charset($link,'utf8');
        $result = mysqli_query($link,"SELECT * FROM m_user where hash_login_id = '" . $id . "';");
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_close($link);
        
        $name = $data[0]['name'];
        $true_hash_login_id = $data[0]['hash_login_id'];
        $true_id = $data[0]['id'];


         // 処理として戻ってきたとき
        if(isset($_POST['state']) && $_POST['state'] == 'update'){

            // 入力値チェック
            // echo 'yyyy';
            
            //passwordの空白チェック
            if(strlen($_POST['password']) == 0){
                $err_msg['password'] = 'パスワードが未入力です' ;
            }
            // 画像の空白チェック
            if(empty($_FILES['upload-file']['name'])){
                $err_msg['img'] = '画像がアップロードされていません';
            }else{

                // 画像サイズを取得
                $upload_file = $_FILES['upload-file'];//imgの何をとってくるのかちゃんと指定する
                $img = $upload_file['name'];
                $size = $upload_file['size'];
                    $temp = explode(".",$img);
                    $num = max(array_keys($temp));//最大値の添え字
                    $ext = $temp[$num];//拡張子

                    // 画像の拡張子チェック
                    if($ext != 'jpg'){// 拡張子がjpg以外
                        $err_msg['img'] = '拡張子は.jpgのみでお願いします';
                    }
                
            }
    
            
            $hash_login_id = $_POST['id'];
            $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
            mysqli_set_charset($link,'utf8');
            $result = mysqli_query($link,"SELECT * FROM m_user where hash_login_id = '" . $id . "';");
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            
    
            mysqli_close($link);
    
            // テーブルに登録されている値
            $true_password = $data[0]['password'];
            $true_hash_login_id = $data[0]['hash_login_id'];
    
            $salt = $data[0]['salt'];//ソルトの値
            $stretch = $data[0]['stretch'];
            $password = $_POST['password'];
                        
            // var_dump($data);
            // echo $salt;
            // echo $stretch;
            
            // 入力されたパスワードを比較用に変換
            for($i = 0;$i < $stretch;$i++){
                $password = md5($password . $salt);
            }
            if((($true_hash_login_id != $_POST['id']) || ($true_password != $password)) && (!isset($err_msg['password']))){
                $err_msg['password'] = 'もう一度正しいパスワードを入力してください';
            }

            // echo 'OK';
            if(isset($err_msg)){
                require_once 'tpl/official_registration.php';
                exit;
            }else{
                
                // 諸々のテーブルデータ更新
                $link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
                mysqli_set_charset($link,'utf8');
                mysqli_query($link,"UPDATE m_user SET user_state = 1,file_name ="  . "'" . $img . "'" . " WHERE id = " . $true_id . ";");
                mysqli_close($link);
    
                
                
                    // 画像格納フォルダ作製
                    mkdir(DIR_IMG . 'user/' . $true_id, 0700);
                    move_uploaded_file($upload_file['tmp_name'],DIR_IMG . 'user/' . $true_id . '/' . $img);
                            $img_size = getimagesize(DIR_IMG . 'user/' . $true_id . '/' . $img);
                                        //  var_dump($img_size);
                                        
                                        $width = $img_size[0];//元の横幅
                                        $height = $img_size[1];//元の高さ
                                        
                                        if($width > 60 || $height > 70){
                                                $w_ratio = $width / 60;//横の比率
                                                $h_ratio = $height / 70;//縦の比率
                
                                                if($w_ratio > $h_ratio){
                                                        $t_ratio = $w_ratio;//使う比率
                                                }elseif($h_ratio > $w_ratio){
                                                        $t_ratio = $h_ratio;//使う比率
                                                }else{
                                                        $t_ratio = $w_ratio;
                                                }
                                        }
                
                                        // 画像ファイルのコピー及び画像ファイルの拡大縮小
                                                // jpg
                                                $img_in = imagecreatefromjpeg(DIR_IMG . 'user/' . $true_id . '/' . $img);
                                                if(isset($t_ratio)){
                                                        $img_out = ImageCreateTruecolor($width / $t_ratio,$height / $t_ratio);
                                                        imagealphablending($img_out,false);
                                                        imagesavealpha($img_out,true);       
                                                        ImageCopyResampled($img_out,$img_in,0,0,0,0,$width / $t_ratio,$height / $t_ratio,$img_size[0],$img_size[1]); 
                                                }else{
                                                        $img_out = ImageCreateTruecolor($width,$height);
                                                        imagealphablending($img_out,false);
                                                        imagesavealpha($img_out,true);       
                                                        ImageCopyResampled($img_out,$img_in,0,0,0,0,$width,$height,$img_size[0],$img_size[1]);                                
                                                }
                                                ImageJpeg($img_out,DIR_IMG . 'user/' . $true_id . '/' . 'thumb_' . $img);
                
                                        ImageDestroy($img_in);
                                        ImageDestroy($img_out);
                
                                    
                                
                                        header('location:./official_registration_com.php');
                                        exit;
            }    
                
            }
    
        }
    
    }

   
    require_once './tpl/official_registration.php';
?>




