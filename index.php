<?php
	require('php_function/dbconnect.php');
	session_start();

	$islogin = false;

	if (array_key_exists('name', $_COOKIE)){
		if($_COOKIE['name'] != '') {
			$_POST['name'] = $_COOKIE['name'];
			$_POST['password'] = $_COOKIE['password'];
			$_POST['save'] = 'on';
		}
	}

	if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
		// ログインしている
		// idがセッションに記録されている
		// 最後の行動から1時間内
		$islogin = true;

	} else {
		// ログインしていない
		$islogin = false;
	}

	if (!empty($_POST)) {
			// ろぐいんのしょり
			if ($_POST['name'] != '' && $_POST['password'] != '') {
					$sql = sprintf('SELECT * FROM members WHERE name = "%s" AND password="%s"',
							mysqli_real_escape_string($db, $_POST['name']),
							mysqli_real_escape_string($db, sha1($_POST['password']))
					);

					$redord = mysqli_query($db, $sql) or die(mysqli_error($db));
					if ($table = mysqli_fetch_assoc($redord)) {
							// ログイン成功
							$_SESSION['id'] = $table['id'];
							// $_SESSION['time'] = $table['time'];

							$islogin = true;

							// ログイン情報を記録する
							if (array_key_exists('save', $_POST) && $_POST['save'] == 'on') {
								setcookie('name', $_POST['name'], time() + 60 * 60 * 24 * 14);
								setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 14);
							}

					} else {
							// code...
							$error['login'] = 'failed';
					}
			} else {
					$error['login'] = 'blank';
			}
	}

?>
<!DOCTYPE html>
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
			<!-- ログインしていないと表示される部分 -->
			<?php if(!$islogin): ?>
				<h2>ログイン</h2>

				<form action = "" method = "post" enctype = "multipart/form-data" class = 'form_column'>
					<dl>
						<dt>ユーザ名</dt>
						<dd>
							<input class='text_box' type = 'text' name='name' value="<?php if (!empty($_POST)): ?>
																																				<?php echo htmlspecialchars($_POST['name']); ?>
																																			<?php endif; ?>"/>

							<?php if (!empty($_POST)): ?>
								<?php if ($error['login'] == 'blank'): ?>
										<p class= 'error'>* メールアドレスとパスワードを記入してください。</p>
								<?php endif; ?>
								<?php if ($error['login'] == 'failed'): ?>
										<p class= 'error'>* ログインに失敗しました。正しく記入してください。</p>
								<?php endif; ?>
							<?php endif; ?>
						</dd>
						<dt>パスワード</dt>
						<dd>
							<input class='text_box' type = 'password' name= 'password' value = "<?php if (!empty($_POST)): ?>
																																										<?php echo htmlspecialchars($_POST['password']); ?>"/>
																																									<?php endif; ?>"/>
						</dd>
						<dt>ログイン情報記録</dt>
						<dd>
							<input id='save' type = 'checkbox' name = 'save' value= 'on'>
							<label for="save">次回からは自動でログインする</label>
						</dd>
					</dl>

					<div class = 'right_button_wrapper'>
						<input type="submit" value="ログイン" class = 'button'/>

						<div class = 'button'>
							<a href = "sign_up/sign_up.php" class = 'link_button'>新規登録</a>
						</div>
					</div>
				</form>
			<?php endif; ?>

			<div class = 'footer' >
				<p><small>&copy; 2016 c-kogyo.net</small></p>
			</div>

		</div>
	</body>
</html>
