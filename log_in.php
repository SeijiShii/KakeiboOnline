<?php
	session_start();
	require('php_function/dbconnect.php');

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
	            $_SESSION['time'] = $table['time'];
	            
	            header('Location: index.php');
	            exit();
	       
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
						<input class='text_box' type = 'text' name='name' value="<?php echo htmlspecialchars($_POST['name']); ?>"/>
						<?php if ($error['login'] == 'blank'): ?>
						    <p class= 'error'>* メールアドレスとパスワードを記入してください。</p>
						<?php endif; ?>
						<?php if ($error['login'] == 'failed'): ?>
						    <p class= 'error'>* ログインに失敗しました。正しく記入してください。</p>
						<?php endif; ?>
					</dd>
					<dt>パスワード</dt>
					<dd>
						<input class='text_box' type = 'password' name= 'password' value = "<?php echo htmlspecialchars($_POST['password']); ?>"/>
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
						<a href = "../sign_up/sign_up.php" class = 'link_button'>新規登録</a>					
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