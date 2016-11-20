<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$query = mysql_query("SELECT * FROM category");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Категории товаров</title>
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
							<a href="category-input.php" class="button small" id="add">Добавить категорию</a>
						</div>
						
						<div class="table-content">							
							<content>
								<table>
									<tbody>
										<tr>											
											<th>Наименование</th>
											<th>Описание</th>
											<th>Операции</th>
										</tr>
										<? while($row = mysql_fetch_row($query)): ?>
										<tr>
											<td><?=$row[1]?></td>
											<td width="500em"><?=$row[2]?></td>
											<td class="show">
												<div class="action">
													<form method="post" action="category-input.php">
														<input type="hidden" name="id_category" value="<?=$row[0]?>" maxlength="0" />														
														<button type="submit" class="button small" id="cng" name="change" title="Изменить"></button>
													</form>
													<form class="delete" method="post">
														<input type="hidden" name="form" value="del-category" maxlength="0" />
														<input type="hidden" name="id_category" value="<?=$row[0]?>" maxlength="0" />
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
			<script src="assets/js/cat-table.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>