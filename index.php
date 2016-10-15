<!DOCTYPE html>

<?php
	if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
		// ログインしている
		// idがセッションに記録されている
		// 最後の行動から1時間内
		
	} else {
		// ログインしていない
		header('Location: log_in/index.php');
		exit();
	}

?>

<html>
	<head>
		<link rel = 'stylesheet' href = 'style.css' type = 'text/css'>
		<meta charset='utf-8'>
		<title>家計簿オンライン</title>
	</head>
	
	<body>
		<div class = 'main_column'>
			<div id = 'app_title'>
				<h1>家計簿オンライン</h1>
			</div>

			<div class = 'footer' >
				<p><small>&copy; 2016 c-kogyo.net</small></p>				
			</div>
		

		</div>
	</body>
</html>