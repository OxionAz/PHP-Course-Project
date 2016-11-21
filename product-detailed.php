<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

if(!$_POST["id_product"]){
	$_POST["id_product"] = $_SESSION["id_product"];	
} else {
	$_SESSION["id_product"] = $_POST["id_product"];
}

$product = mysql_query("SELECT * FROM product WHERE product.id_product = '".$_POST["id_product"]."'");

$sell = mysql_query("SELECT * FROM sell WHERE id_product = '".$_POST["id_product"]."'");
						
$feedback = mysql_query("SELECT user.id_user, user.login, feedback.id_feedback, feedback.title, feedback.rating, feedback.content, feedback.plus, feedback.minus, feedback.date_time 
						FROM user RIGHT JOIN feedback ON user.id_user = feedback.id_user WHERE feedback.id_product = '".$_POST["id_product"]."'");
						
$rating = mysql_query("SELECT AVG(rating) AS rating, COUNT(*) AS amount FROM feedback WHERE id_product = '".$_POST["id_product"]."'");
$star = round(mysql_result($rating, 0, "rating"), 0);

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
							<a href="product.php" class="button small" id="back">Вернуться к продукции</a>
							<a href="product-input.php" class="button small" id="add">Добавить продукт</a>
							<? if($_SESSION["user"]["admin"]): ?>
							<a href="report.php" class="button small" id="rep">Просмотреть отчет</a>
							<? endif; ?>
						</div>
						
						<div class="info-content">
							<header>
								<h1><?=mysql_result($product, 0, "name")?> <?=mysql_result($product, 0, "serial")?></h1>
							</header>
							<div class="info-wrapper">
								<div class="left">
									<div class="icon"></div>
									<div class="rating">
										<? for($i = 0 ; $i < 5 ; $i++){
											if($star != 0){
												echo "<div class='star' id='bold'></div>";
												$star--;
											} else {
												echo "<div class='star'></div>";
											}
										}										
										?>										
										<p>Количество отзывов: <?=mysql_result($rating, 0, "amount")?></p>
									</div>
								</div>								
								<div class="right">
									<div><p class="name">Описание: </p><p><?=mysql_result($product, 0, "description")?></p></div>
									<div><p class="name">Цвет: </p><p><?=mysql_result($product, 0, "color")?></p></div>
									<div><p class="name">Вес: </p><p><?=mysql_result($product, 0, "weight")?> кг.</p></div>
									<div><p class="name">Гарантия: </p><p><?=mysql_result($product, 0, "warranty")?> мес.</p></div>
									<div><p class="name">Цена: </p><p class="price"><?=mysql_result($product, 0, "cost")?> руб.</p></div>
								</div>
							</div>
						</div>
						
						<div class="tabs-content">
							<div class="tabs-nav">
								<button class="button small" id="sell">Продажи</button>
								<button class="button small" id="feedback">Отзывы</button>
							</div>
							
							<div class="tab" id="1">
								<div class="nav">
									<a href="sell-input.php" class="button small" id="add">Добавить продажу</a>
									<a href="sell.php" class="button small" id="see">Просмотреть все продажи</a>
								</div>
								<div class="table-content">
									<content>
										<table>
											<tbody>
												<tr>
													<th>Количество проданных единиц</th>
													<th>Дата</th>													
													<th>Операции</th>
												</tr>
												<? while($row = mysql_fetch_row($sell)): ?>
												<tr>
													<td><?=$row[2]?></td>
													<td><?=$row[3]?></td>
													<td class="show">
														<div class="action">
															<form method="post" action="sell-input.php">
																<input type="hidden" name="id_sell" value="<?=$row[0]?>" maxlength="0" />
																<input type="hidden" name="id_product" value="<?=$_SESSION["id_product"]?>" maxlength="0" />
																<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
															</form>
															<form class="delete" method="post">
																<input type="hidden" name="form" value="del-sell" maxlength="0" />
																<input type="hidden" name="id_sell" value="<?=$row[0]?>" maxlength="0" />
																<button type="submit" class="button small" id="del" name="delete" title="Удалить"></button>
															</form>															
														</div>
													</td>
												</tr>										
												<? endwhile ?>
											<tbody>
										</table>
									</content>
								</div>
							</div>
							
							<div class="tab" id="2">
								<div class="nav">
									<a href="feedback-input.php" class="button small" id="add">Добавить отзыв</a>
									<a href="feedback.php" class="button small" id="see">Просмотреть все отзывы</a>
								</div>
								<? while($row = mysql_fetch_row($feedback)): ?>
								<div class="feedback-content">
									<div class="feedback-wrapper">
										<div class="left">
											<p class="icon"><?=$row[1]?></p>
										</div>
										<div class="center">
											<header>
												<h1><?=$row[3]?></h1>
												<p><?=$row[8]?></p>												
												<div class="rating">													
													<? 
													$count = $row[4];
													
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
														<p class="word"><?=$words[$row[4]]?></p>
													</div>
												</div>
											</header>
											<div><p><?=$row[5]?></p></div>
											<div class="plus-minus">
												<div class="small-icon" id="plus"><p ><?=$row[6]?></p></div>
												<div class="small-icon" id="minus"><p><?=$row[7]?></p></div>
											</div>
										</div>
										<div class="right">
											<? if($_SESSION["user"]["id_user"] == $row[0] || $_SESSION["user"]["admin"]): ?>
											<div class="show">
												<div class="action">
													<form method="post" action="feedback-input.php">
														<input type="hidden" name="id_feedback" value="<?=$row[2]?>" maxlength="0" />
														<input type="hidden" name="id_user" value="<?=$_SESSION["user"]["id_user"]?>" maxlength="0" />
														<input type="hidden" name="id_product" value="<?=$_SESSION["id_product"]?>" maxlength="0" />
														<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
													</form>
													<form class="delete" method="post">
														<input type="hidden" name="form" value="del-feedback" maxlength="0" />
														<input type="hidden" name="id_feedback" value="<?=$row[2]?>" maxlength="0" />
														<button type="submit" class="button small" id="del" name="delete" title="Удалить"></button>
													</form>
												</div>
											</div>
											<? endif; ?>
										</div>
									</div>
								</div>
								<? endwhile ?>
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