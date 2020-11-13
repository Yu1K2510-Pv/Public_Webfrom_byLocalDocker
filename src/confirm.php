<?php
    require "idcontrol.php";
    //include_once "ChromePhp.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームから送信されたデータを各変数に格納
		$name = $_POST["name"];
        $patientid = $_POST["patientid"];
        $section = $_POST["section"];
		$tel = $_POST["tel"];
        $email = $_POST["email"];
        $telemedicine_cnt = $_POST["telemedicine_cnt"];
        $picturefile = $_FILES["picturefile"]["name"];
        $tmp_picturefile = $_FILES["picturefile"]["tmp_name"];
        $request_type = $_POST["request_type"];
        $ReservedDate = $_POST["ReservedDate"];
        $Reservation1 = $_POST["Reservation1"];
        $rsv1ampm = $_POST["rsv1ampm"];
        $Reservation2 = $_POST["Reservation2"];
        $rsv2ampm = $_POST["rsv2ampm"];
        $Reservation3 = $_POST["Reservation3"];
		$rsv3ampm = $_POST["rsv3ampm"];
		$policy = $_POST["policy"];
        $check  = $_POST["check"];
    }
    //ChromePhp::log(empty($picturefile));
    //ChromePhp::log(is_uploaded_file($picturefile));
    $uploaddir = "./Attachments/";
    // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
    if( !empty($tmp_picturefile) && is_uploaded_file($tmp_picturefile) ) {
        $filetype = substr($picturefile, strrpos($picturefile, '.') + 1);
        $uploadfilepath = $uploaddir . $patientid . "_署名済み承諾書写真." . $filetype;
        // ファイルを指定したパスへ保存する
        if(move_uploaded_file($tmp_picturefile, $uploadfilepath)) {
            $filebody = file_get_contents($uploadfilepath);
            $result_file_upload = "アップロードされた画像ファイルは正常に保存されました";
        } else {
            $result_file_upload = "アップロードされた画像ファイルの保存に失敗しました";
        }
    } else {
        $result_file_upload = "画像ファイルのアップロードに失敗しました";
        //ChromePhp::log($uploadfilepath);
        //$filename = $picturefile;
        $filetype = $_POST["filetype"];
        //$filename = $patientid . "_署名済み承諾書写真." . $filetype;
        //ChromePhp::log($filetype);
        //ChromePhp::log($filename);
        $uploadfilepath = $_POST["uploadfilepath"];
        $filename = basename($uploadfilepath);
    }
    //idcontrol.phpから当日の管理番号取得・定義
    list($ctrlnum, $Write_Tofile) = exec_NumberingCtrlNum();
	//  が押されたら場合の処理
	if (isset($_POST["submit"])) {
		// 送信ボタンが押された時に動作する処理をここに記述します。

		$mime_type = "application/octet-stream";

        // メール本文を変数bodyに格納します。
        // 本文の内容については病院で任意に変更願います。'
        $boundary = "__Boundary_" . uniqid(rand(1000, 9999) . "_") . "_";
        //Contents区切り(メール本文)Start
        $body .= "--{$boundary}\n";
        $body .= "Content-Type: text/plain\n";
        $body .= "\n";
        $message_body = <<< EOD
{$name}　様

ホームページの診察予約調整希望受付フォームよりデータが送信されました。

===================================================
【 管理番号 】
{$ctrlnum}

【 お名前 】
{$name}

【 診察券番号 】
{$patientid}

【 診療科 】
{$section}

【 電話番号 】
{$tel}

【 メール 】
{$email}

【当院でのオンライン診療受診回数】
{$telemedicine_cnt}

【署名済み承諾書写真】
{$result_file_upload}
{$picturefile}

【 調整依頼種別 】
{$request_type}

【 受付済み診察予約日 】
{$ReservedDate}

【 第一予約希望日 】
{$Reservation1}
{$rsv1ampm}

【 第二予約希望日 】
{$Reservation2}
{$rsv2ampm}

【 第三予約希望日 】
{$Reservation3}
{$rsv3ampm}
===================================================

※本メールはホームページの診察予約調整希望受付フォームから自動送信されます。

EOD;
        $body .= "{$message_body}\n";
        //ChromePhp::log($uploadfilepath);
        //ChromePhp::log(empty($uploadfilepath));
        //ファイルデータ添付
        if(!empty($uploadfilepath)){
            $filename = basename($uploadfilepath);
            $filebody = file_get_contents($uploadfilepath);
            $attachmentfile = $filename;
            //Contents区切り（添付ファイル）Start
            $body .= "--{$boundary}\n";
            //$body .= "--__BOUNDARY__\n";
            $body .= "Content-Type: application/octet-stream; name=\"{$attachmentfile}\"\n";
            $body .= "Content-Disposition: attachment; filename=\"{$attachmentfile}\"\n";
            $body .= "Content-Transfer-Encoding: base64\n";
            $body .= "\n\n";
            $f_encoded = chunk_split(base64_encode($filebody));
            $body .= $f_encoded . "\n";
            $body .= "--{$boundary}--\n";
            $attachmentfile_validation = "添付ファイルあり";
        } else {
            $attachmentfile_validation = "添付ファイルなし";
        }
        $subject = "【" . $ctrlnum . "】" . $section . "_" . $request_type . "_患者ID：" . $patientid . "_予約調整希望受付フォームから自動送信";

		// 送信元のメールアドレスを変数fromEmailに格納します。
		// 送信元メールアドレスは病院にて任意に変更願います。
		$fromEmail = "contact@webmail.com";

		// 送信元の名前を変数fromNameに格納します。
		// 送信元の名前は病院にて任意に変更願います。
        $fromName = mb_encode_mimeheader(mb_convert_encoding("診察予約調整希望受付フォーム発送", "ISO-2022-JP"));

		// ヘッダ情報を変数headerに格納します。
        $charset = "UTF-8";
        $strHeader = "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";
        // 迷惑メール対策
         $add_params = mb_encode_mimeheader("-f" . $fromEmail,"UTF-8");

		//送信先メールアドレスを設定します。
		//送信先メールアドレスは新情報系HOSPnetのメールアドレスのみになります。
		//病院にて任意に変更願います。
		//$mailto = "xxxxxxx@mail.hosp.go.jp";
        $mailto = "209-jimuonline@mail.hosp.go.jp";

		// メール送信を実施
        mail($mailto, $subject, $body, $strHeader);

        // 管理番号ファイル書き込み処理
        registCtrNum($Write_Tofile);

 		// サンクスページに画面遷移します。
		header("Location: http://localhost:8080/thanks.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<title>診察予約調整希望受付フォーム</title>
<link rel="stylesheet" href="style.css">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div><h1>○○病院</h1></div>
<div><h2>診察予約調整希望　受付内容</h2></div>
<div>
	<form action="confirm.php" method="post" id="confirmform" enctype="multipart/form-data">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="patientid" value="<?php echo $patientid; ?>">
            <input type="hidden" name="section" value="<?php echo $section; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="telemedicine_cnt" value="<?php echo $telemedicine_cnt; ?>">
            <input type="hidden" name="picturefile" value="<?php echo $picturefile; ?>">
            <input type="hidden" name="request_type" value="<?php echo $request_type; ?>">
            <input type="hidden" name="ReservedDate" value="<?php echo $ReservedDate; ?>">
            <input type="hidden" name="Reservation1" value="<?php echo $Reservation1; ?>">
            <input type="hidden" name="rsv1ampm" value="<?php echo $rsv1ampm; ?>">
            <input type="hidden" name="Reservation2" value="<?php echo $Reservation2; ?>">
            <input type="hidden" name="rsv2ampm" value="<?php echo $rsv2ampm; ?>">
            <input type="hidden" name="Reservation3" value="<?php echo $Reservation3; ?>">
            <input type="hidden" name="rsv3ampm" value="<?php echo $rsv3ampm; ?>">
            <input type="hidden" name="uploadfilepath" value="<?php echo $uploadfilepath; ?>">
            <input type="hidden" name="filetype" value="<?php echo $filetype; ?>">
            <h1 class="contact-title">診察予約調整希望 受付内容確認</h1>
            <p>診察予約調整希望受付内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $name; ?></p>
                </div>
                <div>
                    <label>診察券番号</label>
                    <p><?php echo $patientid; ?></p>
                </div>
                <div>
                    <label>診療科</label>
                    <p><?php echo $section; ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $tel; ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $email ?></p>
                </div>
                <div>
                    <label>当院でのオンライン診療受診回数</label>
                    <p><?php echo $telemedicine_cnt ?></p>
                </div>
                <div>
                    <label>署名済み承諾書写真</label>
                    <p><?php echo $picturefile ?></p>
                </div>
                <div>
                    <label>調整依頼種別</label>
                    <p><?php echo $request_type ?></p>
                </div>
                <div>
                    <label>受付済み<br>診察予約日</label>
                    <p><?php echo $ReservedDate ?></p>
                </div>
                <div>
                    <label>第一希望予約日</label>
                    <p><?php echo $Reservation1 ?></p>
                </div>
                <div>
                    <label></label>
                    <p><?php echo $rsv1ampm ?></p>
                </div>
                <div>
                    <label>第二希望予約日</label>
                    <p><?php echo $Reservation2 ?></p>
                </div>
                <div>
                    <label></label>
                    <p><?php echo $rsv2ampm ?></p>
                </div>
                <div>
                    <label>第三希望予約日</label>
                    <p><?php echo $Reservation3 ?></p>
                </div>
                <div>
                    <label></label>
                    <p><?php echo $rsv3ampm ?></p>
                </div>
            </div>
        <input type="button" value="内容を修正する" id="correction" onclick="OnCrrectionButtonClick()">
		<button type="submit" name="submit">送信する</button>
	</form>
</div>
<script type="text/javascript">
function OnCrrectionButtonClick(){
    sessionStorage.clear();
    var param = $("form").serializeArray();
    sessionStorage.setItem("arr_confirm_data",JSON.stringify(param));
    window.history.back();
};
</script>
</body>
</html>