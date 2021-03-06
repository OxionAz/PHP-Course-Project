<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Аккаунт</title>
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
					
						<div class="nav">
							<a href="menu.php" class="button small" id="menu">Меню</a>
							<a href="login-input.php" class="button small" id="cng">Изменить логин</a>
							<a href="email-input.php" class="button small" id="cng">Изменить email</a>
							<a href="password-input.php" class="button small" id="cng">Изменить пароль</a>
							<form class="delete" method="post" action="assets/php/mysql-form-check.php">
								<input type="hidden" name="form" value="del-user" maxlength="0" />
								<input type="hidden" name="id_user" value="<?=$_SESSION["user"]["id_user"]?>" maxlength="0" />
								<button type="submit" class="button " id="del" name="delete" >Удалить аккаунт</button>
							</form>
						</div>
					
						<div class="info-wrapper user">
							<div class="left">
								<div class="icon"></div>								
							</div>								
							<div class="right">
								<div><p class="log"><?=$_SESSION["user"]["login"]?></p></div>
								<div><p class="mail"><?=$_SESSION["user"]["email"]?></p></div>
							</div>
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
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>