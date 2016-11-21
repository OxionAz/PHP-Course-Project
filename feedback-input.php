<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

if($_POST["id_feedback"]){
	$feedback = mysql_query("SELECT * FROM feedback WHERE `id_feedback` = '".$_POST["id_feedback"]."'");
}

$words[1] = "Жуть!";
$words[2] = "Плохо";
$words[3] = "Средне";
$words[4] = "Хорошо";
$words[5] = "Отлично!";

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Отзыв</title>
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
							<? if($_POST["id_feedback"]): ?>
							<h1>Изменить отзыв</h1>
							<? else: ?>
							<h1>Добавить новый отзыв</h1>
							<? endif; ?>
						</header>
						
						<div class="exeption reg">
							<p class="error" id="exep_1">Введенный заголовок некорректен!</p>
						</div>
						
						<form class="feedback" method="post">								
							<input type="hidden" name="form" value="feedback" maxlength="0" />
							<? if($_POST["id_feedback"]): ?>
							<input type="hidden" name="id_feedback" value="<?=$_POST["id_feedback"]?>" maxlength="0" />
							<? endif; ?>
							<input type="hidden" name="id_user" value="<?=$_SESSION["user"]["id_user"]?>" maxlength="0" />
							<input type="hidden" name="id_product" value="<?=$_SESSION["id_product"]?>" maxlength="0" />												
							<div class="field">
								<? if($_POST["id_feedback"]): ?>
								<input class="input" type="text" name="title" placeholder="Заголовок отзыва" maxlength="100" value="<?=mysql_result($feedback, 0, "title")?>" />
								<? else: ?>
								<input class="input" type="text" name="title" placeholder="Заголовок отзыва" maxlength="100" />
								<? endif; ?>
								<div class="hint">Только буквы.</div>
							</div>
							<div class="field">
								<div class="select-wrapper">
									<select class="input" name="rating" id="feedback">
										<option value="default">Поставьте оценку</option>
										<? for($i = 1 ; $i < 6 ; $i++){
											if(mysql_result($feedback, 0, "rating") == $i){
												echo "<option selected value=".$i.">".$words[$i]."</option>";
											} else {
												echo "<option value=".$i.">".$words[$i]."</option>";
											}
										}										
										?>
									</select>
								</div>
							</div>							
							<div class="field">								
								<? if($_POST["id_feedback"]): ?>
								<textarea class="input" type="text" name="content" placeholder="Содержание отзыва" ><?=mysql_result($feedback, 0, "content")?></textarea>								
								<? else: ?>
								<textarea class="input" type="text" name="content" placeholder="Содержание отзыва" ></textarea>
								<? endif; ?>
							</div>
							<div class="field">								
								<? if($_POST["id_feedback"]): ?>
								<textarea class="input" type="text" name="plus" placeholder="Напишите плюсы" maxlength="256" ><?=mysql_result($feedback, 0, "plus")?></textarea>								
								<? else: ?>
								<textarea class="input" type="text" name="plus" placeholder="Напишите плюсы" maxlength="256"></textarea>
								<? endif; ?>
							</div>
							<div class="field">								
								<? if($_POST["id_feedback"]): ?>
								<textarea class="input" type="text" name="minus" placeholder="Напишите минусы" maxlength="256" ><?=mysql_result($feedback, 0, "minus")?></textarea>								
								<? else: ?>
								<textarea class="input" type="text" name="minus" placeholder="Напишите минусы" maxlength="256"></textarea>
								<? endif; ?>
							</div>
							<ul class="actions">
								<? if($_POST["id_feedback"]): ?>
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
			<script src="assets/js/feedb-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>