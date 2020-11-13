<?php

function exec_NumberingCtrlNum(){
     $filename = "numtext/numlist.txt";
     $ret_ctrlnum = "";
     $today_date = date("Ymd");
     if (file_exists($filename)) {
          //$fp = fopen($filename,"r");
          $b_nofile_exists = TRUE;
     }
     if ($b_nofile_exists == TRUE) {
          //管理番号ファイルが開き、末尾１行を取得
          $read_line = file($filename, FILE_IGNORE_NEW_LINES);
          $line_count = count($read_line);
          $check_line_cnt = $line_count - 1;
          //管理番号ファイルにデータが存在する場合
          if ($check_line_cnt != -1){
               $last_line = $read_line[$line_count - 1];
               $check_data = explode(",", $last_line);
               //当日既に発番済みの場合、連番作成
               if ($check_data[0] == $today_date){
                    $Today_Number = $check_data[1];
                    $Write_Number = $Today_Number + 1;
               //当日初めての発番
               } else {
                    $Today_Number = $today_date;
                    $Write_Number = 1;
               }
               $Write_Tofile = $today_date . "," . $Write_Number . "\n";
               $ctrlnum = $today_date . "-" . $Write_Number;
          }
          return [$ctrlnum, $Write_Tofile]; 
     } else {
          $ctrlnum = 0;
          $Write_Tofile = 0;
          return [$ctrlnum, $Write_Tofile]; 
     }
}

function exec_cleardataintxtfile(){
     $filename = "numtext/numlist.txt";
     $status_success = 0;
     $status_failure = -1;
     if (file_exists($filename)) {
          //$fp = fopen($filename,"r");
          $b_nofile_exists = TRUE;
     }
     if ($b_nofile_exists == TRUE){
          $fp = fopen($filename, "r+");
          flock($fp, LOCK_EX);
          //clear data in txtfile
          ftruncate($fp, 0);
          flock($fp, LOCK_EX);
          fclose($fp);
          return $status_success;
     } else {
          return $status_failure;
     }
}

function backCtrlNum_subtract1($now_ctrlnum){
     $check_data = explode("-",$now_ctrlnum);
     $year_month = date("Ym");
     $today_date = date("Ymd");
     $filename = "numtext/" . $year_month . "_numlist.txt";
}

function registCtrNum($regist_ctrlnum){
     //$check_data_regist = explode("-", $regist_ctrlnum);
     $year_month = date("Ym");
     $today_date = date("Ymd");
     $clearfile_success = 0;
     $filename = "numtext/numlist.txt";
     $b_nofile_exists = FALSE;
     if (file_exists($filename)) {
          $b_nofile_exists = TRUE;
     }
     //当該月の管理番号ファイルがすでに存在する場合
      if ($b_nofile_exists == TRUE) {
          $b_clearfile_status = exec_cleardataintxtfile();
          if ($clearfile_status == $clearfile_success){
               //$new_regist_ctrlnum = $check_data_regist[0] . "," . $check_data_regist[1];
               file_put_contents($filename, $regist_ctrlnum, FILE_APPEND);
          } else {
               echo "<script>console.log('Failure clear data in file.');</script>";
          }
     //当該月の管理番号ファイルが存在しない場合
     } else {
          $ctrlnum = $today_date . "-" . "1";
          //POSTパラメータ（管理番号）を設定
          //<input type="hidden" name="ctrlnum" value=\"" . $ctrlnum . \"">
          $Write_Tofile = $today_date . "," . "1\n";
          //当該月の管理番号ファイルを排他ロックで作成
          file_put_contents($filename, $Write_Tofile, LOCK_EX);
          //permisssion?
     }
}