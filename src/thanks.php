<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<title>診察予約調整希望受付フォーム</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div><h1>○○病院</h1></div>
<div><h2>診察予約調整希望受付</h2> </div>
<div>
        <div>
		<h1>診察予約調整希望 送信完了</h1>
		<p>
		診察予約調整希望を受け付けました。<br>
		ご連絡まで今しばらくお待ちください。
		</p>
		<a href="http://localhost:8080/input.php">
			<button type="button" onclick="BeforeBackButtonClick()">フォーム画面に戻る</button>
		</a>
	</div>
</div>
<script type="text/javascript">
	function BeforeBackButtonClick(){
		sessionStorage.clear();
	}
</script>
</body>
</html>