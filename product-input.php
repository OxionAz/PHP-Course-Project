<?php
ini_set("session.save_path",".");
session_start();

if (!$_SESSION["user"]["login"]) header("location: index.php");

include "assets/php/mysql-config.php";

$query = mysql_query("SELECT id_category, name FROM category");

if($_POST["id_product"]){
	$prod = mysql_query("SELECT * FROM product WHERE `id_product` = '".$_POST["id_product"]."'");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Продукт</title>
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
							<? if($_POST["id_product"]): ?>
							<h1>Изменить продукт</h1>
							<? else: ?>
							<h1>Добавить новый продукт</h1>
							<? endif; ?>
						</header>
						
						<div class="exeption reg">
							<p class="error" id="exep_1">Введенное наименование некорректно!</p>
							<p class="error" id="exep_2">Введенный серийный номер некорректен!</p>
							<p class="error" id="exep_3">Введенный вес некорректен!</p>
							<p class="error" id="exep_4">Введенный цвет некорректен!</p>
							<p class="error" id="exep_5">Введенная гарантия некорректна!</p>
							<p class="error" id="exep_6">Введенная стоимость некорректна!</p>
						</div>
						
						<form class="product" method="post">								
							<input type="hidden" name="form" value="product" maxlength="0" />
							<? if($_POST["id_product"]): ?>
							<input type="hidden" name="id_product" value="<?=$_POST["id_product"]?>" maxlength="0" />							
							<? endif; ?>							
							<div class="field">
								<div class="select-wrapper">
									<select class="input" name="id_category" id="category">
										<option value="default">Выберите категорию</option>
										<? while($row = mysql_fetch_row($query)){
											if(mysql_result($prod, 0, "id_category") == $row[0]){
												echo "<option selected value=".$row[0].">".$row[1]."</option>";
											} else {
												echo "<option value=".$row[0].">".$row[1]."</option>";
											}
										}										
										?>
									</select>
								</div>
							</div>							
							<div class="field">
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="name" placeholder="Наименование" maxlength="50" value="<?=mysql_result($prod, 0, "name")?>" />
								<? else: ?>
								<input class="input" type="text" name="name" placeholder="Наименование" maxlength="50" />
								<? endif; ?>
								<div class="hint">Буквы и знак тире.</div>
							</div>
							<div class="field">
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="serial" placeholder="Серийный номер" maxlength="20" value="<?=mysql_result($prod, 0, "serial")?>" />
								<? else: ?>
								<input class="input" type="text" name="serial" placeholder="Серийный номер" maxlength="20" />
								<? endif; ?>
								<div class="hint">Латинские буквы, цифры, знаки тире и скобки.</div>
							</div>
							<div class="field">								
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="weight" placeholder="Вес (кг.)" maxlength="20" value="<?=mysql_result($prod, 0, "weight")?>" />
								<? else: ?>
								<input class="input" type="text" name="weight" placeholder="Вес (кг.)" maxlength="20" />
								<? endif; ?>
								<div class="hint">Цифры и точка.</div>
							</div>
							<div class="field">
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="color" placeholder="Цвет" maxlength="20" value="<?=mysql_result($prod, 0, "color")?>" />
								<? else: ?>
								<input class="input" type="text" name="color" placeholder="Цвет" maxlength="20" />
								<? endif; ?>
								<div class="hint">Только буквы.</div>
							</div>
							<div class="field">								
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="warranty" placeholder="Гарантия (мес.)" maxlength="20" value="<?=mysql_result($prod, 0, "warranty")?>" />
								<? else: ?>
								<input class="input" type="text" name="warranty" placeholder="Гарантия (мес.)" maxlength="20" />
								<? endif; ?>
								<div class="hint">Только цифры.</div>
							</div>
							<div class="field">								
								<? if($_POST["id_product"]): ?>
								<input class="input" type="text" name="cost" placeholder="Стоимость (руб.)" maxlength="20" value="<?=mysql_result($prod, 0, "cost")?>" />
								<? else: ?>
								<input class="input" type="text" name="cost" placeholder="Стоимость (руб.)" maxlength="20" />
								<? endif; ?>
								<div class="hint">Цифры и точка.</div>
							</div>
							<div class="field">								
								<? if($_POST["id_product"]): ?>
								<textarea class="input" type="text" name="description" placeholder="Дополнительное описание продукта" maxlength="256" ><?=mysql_result($prod, 0, "description")?></textarea>								
								<? else: ?>
								<textarea class="input" type="text" name="description" placeholder="Дополнительное описание продукта" maxlength="256"></textarea>
								<? endif; ?>
							</div>
							<ul class="actions">
								<? if($_POST["id_product"]): ?>
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
			<script src="assets/js/prod-form.js"></script>
			<!-- Other -->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>