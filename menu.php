<?php
ini_set("session.save_path",".");
session_start();

if ($_POST["exit"]){
	session_unset();
	session_destroy();	
}

if (!$_SESSION["user"]["login"]) header("location: index.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Меню</title>
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
							<h1>Добро пожаловать <?=$_SESSION["user"]["login"]?>!</h1>
						</header>
						
						<div class="nav p">
							<p>Главное меню</p>
						</div>
						
						<div class="menu">						
							<div class="item">
								<section>										
									<header>
										<h3 id="product">Продукция</h3>
									</header>
									<p>Просмотр и редактирование списка продукции.</p>
									<a href="product.php" class="button small">Просмотреть продукцию</a>
								</section>
							</div>
							
							<? if($_SESSION["user"]["admin"]): ?>
							<div class="item">
								<section>										
									<header>
										<h3 id="report">Отчет</h3>
									</header>
									<p>Вся информация о продажах товаров и отзывах.</p>
									<a href="report.php" class="button small">Просмотреть отчет</a>
								</section>
							</div>
							<? endif; ?>
							
							<div class="item">
								<section>										
									<header>
										<h3 id="account">Аккаунт</h3>
									</header>
									<p>Изменение параметров и управление аккаунтом.</p>									
									<a href="account.php" class="button small">Настроить аккаунт</a>																		
								</section>
							</div>
							
							<div class="item">
								<section>										
									<header>
										<h3 id="exit">Выход</h3>
									</header>
									<p>Выход из аккаунта и завершение сесии.</p>									
									<form class="exit" method="post">
										<input class="button small" type="submit" name="exit" value="Выход из аккаунта">
									</form>
								</section>
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