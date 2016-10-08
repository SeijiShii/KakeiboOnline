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


<?php
	    // A simple PHP script demonstrating how to connect to MySQL.
	    // Press the 'Run' button on the top to start the web server,
	    // then click the URL that is emitted to the Output tab of the console.
	
	    $servername = getenv('IP');
	    // $username = getenv('C9_USER');
	    $username = "seiji";
	    $password = "seiji";
	    $database = "kakeibo_db";
	    $dbport = 3306;
	
	    // Create connection
	    $db = new mysqli($servername, $username, $password, $database, $dbport);
	
	    // Check connection
	    if ($db->connect_error) {
	        die("Connection failed: " . $db->connect_error);
	    } 
	    echo "Connected successfully (".$db->host_info.")";
	    
	    // $db = new mysqli($servername, $username, $password, $database, $dbport) 
	    // 		or die(mysql_connect_errror());
	    // echo "Connected successfully (".$db->host_info.")";
	    mysqli_set_charset($db, "utf8");
	    
	    function mysql_connect_errror() {
	    	echo("Connection failed: ". $db->connect_error);
	    }

?>

<html>
	<head>
		<link rel = 'stylesheet' href = 'style.css' type = 'text/css'>
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
						<a href = "sign_up/sign_up.php" class = 'link_button'>登録する</a>					
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