<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$count = 1;

$product = mysql_query("SELECT category.name, product.id_product, product.name, product.serial, product.weight, product.color, product.warranty, product.cost, product.description 
						FROM category RIGHT JOIN product ON category.id_category = product.id_category ");
						
$category = mysql_query("SELECT category.name, SUM(sell.quantity), TRUNCATE(SUM(product.cost * sell.quantity), 2) 
						FROM category LEFT JOIN product ON category.id_category = product.id_category LEFT JOIN sell ON product.id_product = sell.id_product GROUP BY category.id_category ");
						
$final = mysql_query("SELECT SUM(sell.quantity), TRUNCATE(SUM(product.cost * sell.quantity), 2) 
						FROM product INNER JOIN sell ON product.id_product = sell.id_product ");
						
$words[0] = "Нет";
$words[1] = "Жуть!";
$words[2] = "Плохо";
$words[3] = "Средне";
$words[4] = "Хорошо";
$words[5] = "Отлично!";

$chart[0][0] = "Task";
$chart[0][1] = "Hours per Day";
$chart[1][0] = "Work";
$chart[1][1] = 11;
$chart[2][0] = "Eat";
$chart[2][1] = 2;
$chart[3][0] = "Commute";
$chart[3][1] = 2;
$chart[4][0] = "Watch TV";
$chart[4][1] = 2;
$chart[5][0] = "Sleep";
$chart[5][1] = 7;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Отчет</title>
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
						</div>
						
						<div class="report">
							<header>
								<h1>Отчет по продукции</h1>
							</header>
							<? while($prod = mysql_fetch_row($product)): ?>
							<p class="title">Продукт №<?=$count?></p>
							<div class="desc">Информация о продукте</div>
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
											</tr>										
											<tr>
												<td><?=$prod[0]?></td>
												<td><?=$prod[2]?></td>
												<td><?=$prod[3]?></td>
												<td><?=$prod[4]?> <? if($prod[4]) echo "кг." ?></td>
												<td><?=$prod[5]?></td>
												<td><?=$prod[6]?> <? if($prod[6]) echo "мес." ?></td>
												<td><?=$prod[7]?> <? if($prod[7]) echo "руб." ?></td>											
											</tr>										
										<tbody>
									</table>
								</content>
							</div>
							<div class="desc">Продажи продукта</div>
							<div class="table-content">
								<content>
									<table class="c">
										<tbody>
											<tr>
												<th>Количество проданных единиц</th>
												<th>Выручка</th>
												<th>Дата</th>
											</tr>
											<? $sell = mysql_query("SELECT * FROM sell WHERE id_product = '".$prod[1]."'"); ?>
											<? while($sel = mysql_fetch_row($sell)): ?>										
											<tr>
												<td><?=$sel[2]?></td>
												<td><?=$sel[2] * $prod[7]?> руб.</td>
												<td><?=$sel[3]?></td>
											</tr>										
											<? endwhile; ?>
										<tbody>
									</table>
								</content>
							</div>
							<div class="table-content">
								<content>
									<table>
										<tbody>
											<tr>
												<th>Всего продано единиц</th>
												<th>Общая выручка</th>
											</tr>
											<? $score = mysql_query("SELECT SUM(sell.quantity) AS quantity FROM sell WHERE sell.id_product = '".$prod[1]."'"); ?>
											<tr>
												<td><?=mysql_result($score, 0, "quantity")?></td>
												<td><?=mysql_result($score, 0, "quantity") * $prod[7]?> руб.</td>
											</tr>											
										<tbody>
									</table>
								</content>
							</div>
							<div class="desc">Отзывы о продукте</div>
							<div class="table-content">
								<content>
									<table class="end">
										<tbody>
											<tr>
												<th>Количество отзывов</th>
												<th>Средняя оценка</th>
												<th>Определение</th>
											</tr>
											<? 
												$feedback = mysql_query("SELECT AVG(rating) AS rating, COUNT(*) AS amount FROM feedback WHERE id_product = '".$prod[1]."'");
												$rating = round(mysql_result($feedback, 0, "rating"), 0);
											?>																		
											<tr>
												<td><?=mysql_result($feedback, 0, "amount")?></td>
												<td><?=$rating?></td>
												<td><?=$words[$rating]?></td>
											</tr>										
										<tbody>
									</table>
								</content>
							</div>
							<? $count++; ?>
							<? endwhile; ?>
							<header>
								<h1>Отчет по категориям</h1>
							</header>
							<div class="table-content">
								<content>
									<table class="c">
										<tbody>
											<tr>
												<th>Наименование категории</th>
												<th>Количество проданных единиц</th>
												<th>Выручка</th>
											</tr>											
											<? while($cat = mysql_fetch_row($category)): ?>										
											<tr>
												<td><?=$cat[0]?></td>
												<td><? if($cat[1]) echo $cat[1]; else echo 0; ?></td>
												<td><? if($cat[2]) echo $cat[2]; else echo 0; ?> руб.</td>
											</tr>										
											<? endwhile; ?>
										<tbody>
									</table>
								</content>
							</div>
							<div class="table-content">
								<content>
									<table>
										<tbody>
											<tr>												
												<th>Общее количество проданных единиц</th>
												<th>Общая выручка</th>
											</tr>											
											<? while($fin = mysql_fetch_row($final)): ?>										
											<tr>
												<td><? if($fin[0]) echo $fin[0]; else echo 0; ?></td>
												<td><? if($fin[1]) echo $fin[1]; else echo 0; ?> руб.</td>
											</tr>										
											<? endwhile; ?>
										<tbody>
									</table>
								</content>
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
			
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>>