<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$sell = mysql_query("SELECT category.name, product.id_product, product.name, product.serial, sell.id_sell, sell.quantity, sell.date 
						FROM category RIGHT JOIN product ON category.id_category = product.id_category RIGHT JOIN sell ON product.id_product = sell.id_product ");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Все продажи</title>
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
						
						<div class="table-content">
							<content>
								<table>
									<tbody>
										<tr>
											<th>Категория</th>
											<th>Продукт</th>
											<th>Серийный номер</th>
											<th>Продано</th>
											<th>Дата</th>
											<th>Операции</th>
										</tr>
										<? while($row = mysql_fetch_row($sell)): ?>
										<tr>
											<td><?=$row[0]?></td>
											<td><?=$row[2]?></td>
											<td><?=$row[3]?></td>
											<td><?=$row[5]?></td>
											<td><?=$row[6]?></td>
											<td class="show">
												<div class="action">
													<form method="post" action="sell-input.php">
														<input type="hidden" name="id_sell" value="<?=$row[4]?>" maxlength="0" />
														<input type="hidden" name="id_product" value="<?=$row[1]?>" maxlength="0" />
														<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
													</form>
													<form class="delete" method="post">
														<input type="hidden" name="form" value="del-sell" maxlength="0" />
														<input type="hidden" name="id_sell" value="<?=$row[4]?>" maxlength="0" />
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