<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Изменить пароль</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
					
						<header>							
							<h1>Изменить пароль</h1>
						</header>
						
						<div class="exeption reg">
							<p class="error" id="exep_1">Введенный пароль неверен!</p>
							<p class="error" id="exep_2">Введенный пароль некорректен!</p>
							<p class="error" id="exep_3">Введенные пароли не совпадают!</p>
						</div>
						
						<form class="account" method="post">
							<input type="hidden" name="form" value="password" maxlength="0" />												
							<div class="field">
								<input class="input" type="password" name="password" placeholder="Введите текущий пароль" maxlength="20" />
							</div>
							<div class="field">
								<input class="input" type="password" name="new_password" placeholder="Введите новый пароль" maxlength="20" />
								<div class="hint">От 3 до 20 символов.<br>Латинские буквы, цифры, знаки тире и подчеркивания.</div>
							</div>
							<div class="field">
								<input class="input" type="password" name="new_password_asset" placeholder="Повторите пароль" maxlength="20" />
							</div>
							<ul class="actions">
								<li><input class="button_add bad" type="submit" value="Изменить"></li>								
								<li><input class="button_cancel" type="button" value="Отмена"></li>
							</ul>
						</form>
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>Зоткин Александр</li><li>2016</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<!-- Libs -->
			<script src="assets/libs/jquery-1.8.2.min.js"></script>
			<!-- My scripts -->
			<script src="assets/js/account-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>