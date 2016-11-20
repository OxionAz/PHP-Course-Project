<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$query = mysql_query("SELECT category.name, product.id_product, product.name, product.serial, product.weight, product.color, product.warranty, product.cost, product.description 
						FROM category RIGHT JOIN product ON category.id_category = product.id_category ");
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
							<a href="menu.php" class="button small" id="back">Вернуться обратно</a>
							<a href="product-input.php" class="button small" id="prod">Добавить продукт</a>
							<a href="category.php" class="button small" id="cat">Категории продукции</a>
							<? if($_SESSION["user"]["admin"]): ?>
							<a href="report.php" class="button small" id="rep">Просмотреть отчет</a>
							<? endif; ?>
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
										<? while($row = mysql_fetch_row($query)): ?>
										<tr>
											<td><?=$row[0]?></td>
											<td><?=$row[2]?></td>
											<td><?=$row[3]?></td>
											<td><?=$row[4]?> <? if($row[4]) echo "кг." ?></td>
											<td><?=$row[5]?></td>
											<td><?=$row[6]?> <? if($row[6]) echo "мес." ?></td>
											<td><?=$row[7]?> <? if($row[7]) echo "руб." ?></td>
											<td class="show">
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
													<form class="info" method="post" action="product.php">
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
			<script src="assets/js/prod-table.js"></script>
			<script src="assets/js/prod-table-del.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>