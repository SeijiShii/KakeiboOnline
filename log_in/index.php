<!DOCTYPE html>

<?php
	session_start();
	
	if (!empty($_POST)) {
		// エラー項目の確認
		if ($_POST['name'] == '') {
			$error['name'] = 'blank';
		}
		
		if (strlen($_POST['password']) < 4) {
			$error['password'] = 'length';
		}
		
		if ($_POST['password'] == '') {
			$error['password'] = 'blank';
		}
		
		if (empty($error)) {
			$_SESSION['join'] = $_POST;
			header('Location: check_account.php');
			exit();
		}
	}
?>

<html>
	<head>
		<link rel = 'stylesheet' href = '../style.css' type = 'text/css'>
		<meta charset='utf-8'>
		<title>家計簿オンライン　ログイン</title>
	</head>
	
	<body>
		<div class = 'main_column'>
			<div id = 'app_title'>
				<h1>家計簿オンライン</h1>
			</div>
			<h2>ログイン</h2>
			
			<form action = "" method = "post" enctype = "multipart/form-data" class = 'form_column'>
				<dl>
					<dt>ユーザ名</dt>
					<dd>
						<input class='text_box' type = 'text'>
					</dd>
					<dt>パスワード</dt>
					<dd>
						<input class='text_box' type = 'password'>
					</dd>
				</dl>

				<div class = 'right_button_wrapper'>
					<input type="submit" value="ログイン" class = 'button'/>
					
					<br>
					<br>
					<br>
					<div class = 'button'>
						<a href = "sign_up/sign_up.php" class = 'link_button'>新規登録</a>					
					</div>
				</div>

			</form>
		
			<br>
			<br>
			<br>
			<div class = 'footer'>
				<p>このアプリにはソーシャル機能はないためユーザ名等が公開されることはありません。</p>
				<p><small>&copy; 2016 c-kogyo.net</small></p>				
			</div>
		

		</div>
	</body>
</html>