<?php
    function isYmd($date){
 
        //（必須チェックは別機能で対応する場合、）入力しない場合スルーする
        if ($date == '') {
            return true;
        }
         
        //19xx,20xx年が有効、ここは月と日の桁数だけを制御し、存在チェックは次のcheckdate関数で行う 
        if(!preg_match('/^(19|20)[0-9]{2}\/\d{2}\/\d{2}$/', $date)){
            
            return '0000-00-00';
        }
     
        list($y, $m, $d) = explode('/', $date);
     
        if(!checkdate($m, $d, $y)){
            return false;
        }
        return true;
    }
?>