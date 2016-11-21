<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$feedback = mysql_query("SELECT user.login, user.admin, feedback.id_user, feedback.id_feedback, feedback.id_product, feedback.title, feedback.rating, feedback.content, feedback.plus, feedback.minus, feedback.date_time, product.name, product.serial 
						FROM user INNER JOIN feedback ON user.id_user = feedback.id_user INNER JOIN product ON feedback.id_product = product.id_product ");

$words[1] = "Жуть!";
$words[2] = "Плохо";
$words[3] = "Средне";
$words[4] = "Хорошо";
$words[5] = "Отлично!";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Товары</title>
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
							<a href="product-detailed.php" class="button small" id="back">Вернуться к продукту</a>
						</div>					
						
						<? while($row = mysql_fetch_row($feedback)): ?>
						<div class="feedback-content">							
							<div class="feedback-wrapper">
								<div class="left">
									<p class="icon"><?=$row[0]?></p>
								</div>
								<div class="center">									
									<header>
										<p><?=$row[11]?> <?=$row[12]?></p>
										<h1><?=$row[5]?></h1>
										<p><?=$row[10]?></p>
										<div class="rating">													
											<? 
											$count = $row[6];
											
											for($i = 0 ; $i < 5 ; $i++){
												if($count != 0){
													echo "<div class='star' id='bold'></div>";
													$count--;
												} else {
													echo "<div class='star'></div>";
												}
											}										
											?>													
											<div>
												<p class="word"><?=$words[$row[6]]?></p>
											</div>
										</div>
									</header>
									<div><p><?=$row[7]?></p></div>
									<div class="plus-minus">
										<div class="small-icon" id="plus"><p ><?=$row[8]?></p></div>
										<div class="small-icon" id="minus"><p><?=$row[9]?></p></div>
									</div>
								</div>
								<div class="right">
									<? if($_SESSION["user"]["id_user"] == $row[2] || $_SESSION["user"]["admin"]): ?>
									<div class="show">
										<div class="action">
											<form method="post" action="feedback-input.php">
												<input type="hidden" name="id_feedback" value="<?=$row[3]?>" maxlength="0" />
												<input type="hidden" name="id_user" value="<?=$row[2]?>" maxlength="0" />
												<input type="hidden" name="id_product" value="<?=$row[4]?>" maxlength="0" />
												<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
											</form>
											<form class="delete" method="post">
												<input type="hidden" name="form" value="del-feedback" maxlength="0" />
												<input type="hidden" name="id_feedback" value="<?=$row[3]?>" maxlength="0" />
												<button type="submit" class="button small" id="del" name="delete" title="Удалить"></button>
											</form>
										</div>
									</div>
									<? endif; ?>
								</div>
							</div>						
						</div>
						<? endwhile ?>
								
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
			<script src="assets/js/prod-det-table-logic.js"></script>
			<script src="assets/js/prod-det-logic.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>