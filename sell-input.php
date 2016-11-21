<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

if($_POST["id_sell"]){
	$sell = mysql_query("SELECT * FROM sell WHERE `id_sell` = '".$_POST["id_sell"]."'");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Продажа</title>
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
							<? if($_POST["id_sell"]): ?>
							<h1>Изменить продажу</h1>
							<? else: ?>
							<h1>Добавить новую продажу</h1>
							<? endif; ?>
						</header>
						
						<div class="exeption reg">
							<p class="error" id="exep_1">Введенное количество некорректно!</p>
							<p class="error" id="exep_2">Введенная дата некорректна!</p>
						</div>
						
						<form class="sell" method="post">
							<input type="hidden" name="form" value="sell" maxlength="0" />
							<input type="hidden" name="id_product" value="<?=$_SESSION["id_product"]?>" maxlength="0" />
							<? if($_POST["id_sell"]): ?>
							<input type="hidden" name="id_sell" value="<?=$_POST["id_sell"]?>" maxlength="0" />
							<? endif; ?>
							<div class="field">
								<? if($_POST["id_sell"]): ?>
								<input class="input" type="text" name="quantity" placeholder="Количество проданного продукта" maxlength="20" value="<?=mysql_result($sell, 0, "quantity")?>" />
								<? else: ?>
								<input class="input" type="text" name="quantity" placeholder="Количество проданного продукта" maxlength="20" />
								<? endif; ?>
								<div class="hint">Только цифры.</div>
							</div>							
							<div class="field">								
								<? if($_POST["id_sell"]): ?>
								<input class="input" type="text" name="date" placeholder="Дата продажи" maxlength="20" value="<?=mysql_result($sell, 0, "date")?>" />
								<? else: ?>
								<input class="input" type="text" name="date" placeholder="Дата продажи" maxlength="20" />
								<? endif; ?>
								<div class="hint">В формате ГГГГ-ММ-ДД.<br>Например: 2016-01-24.</div>
							</div>
							<ul class="actions">
								<? if($_POST["id_sell"]): ?>
								<li><input class="button_add bad" type="submit" value="Изменить"></li>								
								<? else: ?>
								<li><input class="button_add bad" type="submit" value="Добавить"></li>
								<? endif; ?>
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
			<script src="assets/js/sell-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>