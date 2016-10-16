<!DOCTYPE html>

<?php
	session_start();
	
	require('../php_function/dbconnect.php');
	
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
		
		// 重複アカウント確認　DB内に同じ名前のアカウントがあるか
		if (empty($error)) {
			
			$sql = sprintf("SELECT COUNT(*) AS cnt FROM members WHERE name = '%s'",
				mysqli_real_escape_string($db, $_POST['name'])
			);
			
			$record = mysqli_query($db, $sql) or die(mysqli_error($db));
			$table = mysqli_fetch_assoc($record);
			
			if ($table['cnt'] > 0) {
				$error['name'] = 'duplicate';
			}
			
			if (empty($error)) {
				$_SESSION['sign_up'] = $_POST;
				header('Location: check_account.php');
				exit();
			}
		
	
	}

	// 書き直し
	if ($_REQUEST['action'] == 'rewrite') {
		
		$_POST = $_SESSION['sign_up'];
		$_error['rewrite'] == true;
	}


		
	}

?>

<html>
	<head>
		<link rel = 'stylesheet' href = '../style.css' type = 'text/css'>
		<meta charset='utf-8'>
		<title>家計簿オンライン　登録</title>
	</head>
	
	<body>
		<div class = 'main_column'>
			<div id = 'app_title'>
				<h1>家計簿オンライン</h1>
			</div>
			<h2>登録</h2>
			
			<form action = "" method = "post" enctype = "multipart/form-data" class = 'form_column'>
				<dl>
					<dt>ユーザ名</dt>
					<dd>
						<input class='text_box' type = 'text' name = "name" value = "<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') ?>"/>
						<?php if ($error['name'] == 'blank'): ?>
						<p class = 'error'>* ユーザ名を入力してください。</p>
						<?php endif; ?>
						<?php if($error['name'] == 'duplicate'): ?>
						<p class= 'error'>* 指定された指定されたユーザ名は既に登録されています。</p>
						<?php endif; ?>
					</dd>
					<dt>パスワード</dt>
					<dd>
						<input class='text_box' type = 'password' name = "password" value = "<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8') ?>">
						<?php if ($error['password'] == 'blank'): ?>
							<p class = 'error'>* パスワードを入力してください。</p>
						<?php elseif ($error['password'] == 'length'): ?>
							<p class = 'error'>* パスワードが短すぎます。(5文字以上)</p>
						<?php endif; ?>
					</dd>
				</dl>

				<div class = 'right_button_wrapper'>
					<input type="submit" value="入力内容を確認する" class = 'button'/>
				</div>

			</form>
		
			<div class = 'footer'>
				<p>このアプリにはソーシャル機能はないためユーザ名等が公開されることはありません。</p>
				<p><small>&copy; 2016 c-kogyo.net</small></p>				
			</div>
		

		</div>
	</body>
</html>