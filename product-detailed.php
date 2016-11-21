<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$product = mysql_query("SELECT * FROM product WHERE product.id_product = '".$_POST["id_product"]."'");

$sell = mysql_query("SELECT * FROM sell WHERE id_product = '".$_POST["id_product"]."'");
						
$feedback = mysql_query("SELECT user.name, product.name, product.serial, product.weight, product.color, product.warranty, product.cost, product.description 
						FROM user RIGHT JOIN feedback ON user.id_user = feedback.id_user WHERE feedback.id_product = '".$_POST["id_product"]."'");
						
$rating = mysql_query("SELECT AVG(rating) AS rating, COUNT(*) AS amount FROM user WHERE feedback.id_product = '".$_POST["id_product"]."'");
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
										<div class="star" id="bold"></div>
										<div class="star" id="bold"></div>
										<div class="star" id="bold"></div>
										<div class="star" id="bold"></div>
										<div class="star"></div>
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
									<a href="product-input.php" class="button small" id="add">Добавить продажу</a>
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
													<td class="show widely">
														<div class="action">
															<form method="post" action="product-input.php">														
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />														
																<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
															</form>
															<form class="delete" method="post">
																<input type="hidden" name="form" value="del-product" maxlength="0" />
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />
																<button type="submit" class="button small" id="del" name="delete" title="Удалить"></button>
															</form>
															<form class="info" method="post" action="product-detailed.php">
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />
																<button type="submit" class="button small" id="det" name="detailed" title="Получить полную информацию о продукте">Подробно</button>
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
									<a href="product-input.php" class="button small" id="add">Добавить продажу</a>
								</div>
								<div class="table-content">
									<content>
										<table>
											<tbody>
												<tr>
													<th>Категория</th>
													<th>Наименование</th>
													<th>Серийный номер</th>
													<th>Вес</th>
													<th>Цвет</th>
													<th>Гарантия</th>
													<th>Цена</th>
													<th>Операции</th>
												</tr>
												<? while($row = mysql_fetch_row($feedback)): ?>
												<tr>
													<td><?=$row[0]?></td>
													<td><?=$row[2]?></td>
													<td><?=$row[3]?></td>
													<td><?=$row[4]?> <? if($row[4]) echo "кг." ?></td>
													<td><?=$row[5]?></td>
													<td><?=$row[6]?> <? if($row[6]) echo "мес." ?></td>
													<td><?=$row[7]?> <? if($row[7]) echo "руб." ?></td>
													<td class="show widely">
														<div class="action">
															<form method="post" action="product-input.php">														
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />														
																<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
															</form>
															<form class="delete" method="post">
																<input type="hidden" name="form" value="del-product" maxlength="0" />
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />
																<button type="submit" class="button small" id="del" name="delete" title="Удалить"></button>
															</form>
															<form class="info" method="post" action="product-detailed.php">
																<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />
																<button type="submit" class="button small" id="det" name="detailed" title="Получить полную информацию о продукте">Подробно</button>
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
			<script src="assets/js/table-logic.js"></script>
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