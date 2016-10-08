<!DOCTYPE html>

<?php 
    session_start();
    
    if (!isset($_SESSION['sign_up'])) {
        header('Location: index.php');
        exit();
    }
?>

<html>
	<head>
		<link rel = 'stylesheet' href = '../style.css' type = 'text/css'>
		<meta charset='utf-8'>
		<title>家計簿オンライン　登録内容確認</title>
	</head>
	
	<body>
		<div class = 'main_column' align = 'center'>
			<div id = 'app_title'>
				<h1>家計簿オンライン</h1>
			</div>
			<h2>登録内容確認</h2>
			
			<form action = "" method = "post" enctype = "multipart/form-data" class = 'form_column'>
				<table>
					<tr>
						<td>ユーザ名</td>
						<td>
						    <?php echo htmlspecialchars($_SESSION['sign_up']['name'], ENT_QUOTES, 'UTF-8') ?>
						</td>
					</tr>
					<tr>
						<td>パスワード</td>
						<td>[表示されません]</td>
					</tr>
				</table>
				
				<div class = 'button'>
				    <a href = '../sign_up/sign_up.php?action=rewrite' class = 'link_button'>&laquo;&nbsp;書き直す</a>
				</div>
				<br>
		        <br>
		        <br>
		        <br>
				
				<input type="submit" value="登録する" class = 'button'/>
			</form>
			<br>
			<br>
			<p>このアプリにはソーシャル機能はありませんのでユーザ名等が公開されることはありません。</p>
			<p><small>&copy; 2016 c-kogyo.net</small></p>
		</div>
	</body>
</html>