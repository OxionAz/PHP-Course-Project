<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

if($_POST["id_category"]){
	$prod = mysql_query("SELECT * FROM category WHERE `id_category` = '".$_POST["id_category"]."'");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Категория</title>
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
							<? if($_POST["id_category"]): ?>
							<h1>Изменить категорию</h1>
							<? else: ?>
							<h1>Добавить новую категорию</h1>
							<? endif; ?>
						</header>
						
						<div class="exeption reg">
							<p class="error" id="exep_1">Введенное наименование некорректно!</p>
						</div>
						
						<form class="category" method="post">
							<input type="hidden" name="form" value="category" maxlength="0" />
							<? if($_POST["id_category"]): ?>
							<input type="hidden" name="id_category" value="<?=$_POST["id_category"]?>" maxlength="0" />
							<? endif; ?>
							<div class="field">
								<? if($_POST["id_category"]): ?>
								<input class="input" type="text" name="name" placeholder="Наименование" maxlength="30" value="<?=mysql_result($prod, 0, "name")?>" />
								<? else: ?>
								<input class="input" type="text" name="name" placeholder="Наименование" maxlength="30" />
								<? endif; ?>
								<div class="hint">Буквы и знак тире.</div>
							</div>							
							<div class="field">								
								<? if($_POST["id_category"]): ?>
								<textarea class="input" type="text" name="description" placeholder="Дополнительное описание категории" maxlength="256" ><?=mysql_result($prod, 0, "description")?></textarea>								
								<? else: ?>
								<textarea class="input" type="text" name="description" placeholder="Дополнительное описание категории" maxlength="256"></textarea>
								<? endif; ?>
							</div>
							<ul class="actions">
								<? if($_POST["id_category"]): ?>
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
			<script src="assets/js/cat-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>