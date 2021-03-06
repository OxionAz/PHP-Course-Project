<?php
ini_set("session.save_path",".");
session_start();

if ($_SESSION["user"]["login"]) header("location: menu.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Торговый центр</title>
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
						
						<div id="log_in">
							<header>
								<span class="avatar"><img src="images/avatar.svg" alt="icon"/></span>
								<h1>Система оценки продаж продукции<br>в торговом центре</h1>
								<p>Вход в систему</p>
							</header>
							
							<div class="exeption ent">
								<p class="error" id="exep_1">Пользователь с таким именем не найден!</p>
								<p class="error" id="exep_2">Неверный пароль!</p>
							</div>
							
							<form class="enter" method="post">
								<input type="hidden" name="form" value="user" maxlength="0"/>
								<div class="field">
									<input class="input" type="text" name="login" placeholder="Логин" maxlength="20" />
								</div>
								<div class="field">
									<input class="input" type="password" name="password" placeholder="Пароль" maxlength="20" />
								</div>
								<ul class="actions">
									<li><input class="button_log bad" id="log" type="submit" value="Вход"></li>
									<li><input class="button_reg" id="reg" type="button" value="Регистрация"></li>
								</ul>
							</form>
						</div>
						
						<div id="log_up">
							<header>									
								<h1>Регистрация</h1>
							</header>
							
							<div class="exeption reg">
								<p class="error" id="exep_1">Введенный логин уже занят!</p>
								<p class="error" id="exep_2">Введенный логин некорректен!</p>
								<p class="error" id="exep_3">Введенный email некорректен!</p>
								<p class="error" id="exep_4">Введенный пароль некорректен!</p>
								<p class="error" id="exep_5">Введенные email-лы не совпадают!</p>
								<p class="error" id="exep_6">Введенные пароли не совпадают!</p>
							</div>
							
							<form class="registration" method="post">								
								<input type="hidden" name="form" value="registration" maxlength="0" />
								<div class="field">									
									<input class="input" type="text" name="login" placeholder="Логин" maxlength="20" />
									<div class="hint">От 3 до 20 символов.<br>Латинские буквы, цифры, знаки тире и подчеркивания.</div>
								</div>
								<div class="field">
									<input class="input" type="text" name="email" placeholder="Email" maxlength="20" />
									<div class="hint">Например: example@mail.com</div>
								</div>
								<div class="field">
									<input class="input" type="text" name="email_asset" placeholder="Повторите email" maxlength="20" />
								</div>
								<div class="field">
									<input class="input" type="password" name="password" placeholder="Пароль" maxlength="20" />
									<div class="hint">От 3 до 20 символов.<br>Латинские буквы, цифры, знаки тире и подчеркивания.</div>
								</div>
								<div class="field">
									<input class="input" type="password" name="password_asset" placeholder="Повторите пароль" maxlength="20" />
								</div>
								<ul class="actions">
									<li><input class="button_reg bad" type="submit" value="Зарегистрироваться"></li>
									<li><input class="button_cancel" type="button" value="Отмена"></li>
								</ul>
							</form>
						</div>
						
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
			<script src="assets/js/user-form.js"></script>
			<script src="assets/js/reg-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>