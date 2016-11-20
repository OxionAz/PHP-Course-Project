<?php
ini_set("session.save_path","../../.");
session_start();

include "mysql-config.php";
include "input-check.php";

switch($_POST["form"]){
	
	case "user":{
		
		$query = mysql_query("SELECT * FROM `user` WHERE `login` = '".$_POST["login"]."' LIMIT 1");
	
		if (mysql_num_rows($query) == 1){
			
			$_SESSION["user"] = array(
			"id_user"=>mysql_result($query, 0, "id_user"),
			"login"=>mysql_result($query, 0, "login"), 
			"email"=>mysql_result($query, 0, "email"),
			"password"=>mysql_result($query, 0, "password"), 
			"admin"=>mysql_result($query, 0, "admin"));
			
			if ($_POST["password"] == $_SESSION["user"]["password"]){
				$json = true;
			} else {
				$json = 2;
			}
			
		} else {
			$json = 1;
		}
		echo json_encode($json);
		
	} break;
	
	case "registration":{
		
		$query = mysql_query("SELECT * FROM `user` WHERE `login` = '".$_POST["login"]."' LIMIT 1");
		
		if (mysql_num_rows($query) == 1){
			$json = 1;
		} else if (!checkUserLogin($_POST["login"])){
			$json = 2;
		} else if (!checkUserEmail($_POST["email"])){
			$json = 3;
		} else if (!checkUserPassword($_POST["password"])){
			$json = 4;
		} else if ($_POST["email"] != $_POST["email_asset"]){
			$json = 5;
		} else if ($_POST["password"] != $_POST["password_asset"]){
			$json = 6;
		} else {
			$query = mysql_query("INSERT INTO `user` VALUE(null, '".strtolower($_POST["login"])."', '".strtolower($_POST["email"])."', '".$_POST["password"]."', false)");
			$query = mysql_query("SELECT * FROM `user` WHERE `login` = '".$_POST["login"]."' LIMIT 1");
			
			$_SESSION["user"] = array(
			"id_user"=>mysql_result($query, 0, "id_user"),
			"login"=>mysql_result($query, 0, "login"), 
			"email"=>mysql_result($query, 0, "email"),
			"password"=>mysql_result($query, 0, "password"), 
			"admin"=>mysql_result($query, 0, "admin"));
			
			$json = true;
		}		
		echo json_encode($json);
		
	} break;
	
	case "product":{
		
		if (!checkName($_POST["name"])){
			$json = 1;
		} else if (!checkSerial($_POST["serial"])){
			$json = 2;
		} else if (!checkFloat($_POST["weight"])){
			$json = 3;
		} else if (!checkText($_POST["color"])){
			$json = 4;
		} else if (!checkNumber($_POST["warranty"])){
			$json = 5;
		} else if (!checkFloat($_POST["cost"])){
			$json = 6;
		} else if ($_POST["id_product"]){			
			$query = mysql_query("UPDATE `product` SET `id_category` = '".$_POST["id_category"]."', `name` = '".$_POST["name"]."', `serial` = '".$_POST["serial"]."', `weight` = '".$_POST["weight"]."', `color` = '".$_POST["color"]."', `warranty` = '".$_POST["warranty"]."', `cost` = '".$_POST["cost"]."', `description` = '".$_POST["description"]."' WHERE `id_product` = '".$_POST["id_product"]."'");
			
			$json = true;
		} else {
			if(!$_SESSION["add"]) {
				$query = mysql_query("INSERT INTO `product` VALUE
				(null
				, '".$_POST["id_category"]."'
				, '".$_POST["name"]."'
				, '".$_POST["serial"]."'
				, '".$_POST["weight"]."'
				, '".$_POST["color"]."'
				, '".$_POST["warranty"]."'
				, '".$_POST["cost"]."'
				, '".$_POST["description"]."')");	
				
				$json = true;
				$_SESSION["add"] = $json;
			} else {
				$json = false;
				$_SESSION["add"] = null;
			}
		}		
		echo json_encode($json);
		
	} break;
	
	case "del-product":{		
		
		$query = mysql_query("DELETE FROM `product` WHERE `id_product` = '".$_POST["id_product"]."'");		
		$json = true;
		
		echo json_encode($json);
		
	} break;
	
	case "category":{
		
		if (!checkName($_POST["name"])){
			$json = 1;		
		} else if ($_POST["id_category"]){
			$query = mysql_query("UPDATE `category` SET `name` = '".$_POST["name"]."', `description` = '".$_POST["description"]."' WHERE `id_category` = '".$_POST["id_category"]."'");
			
			$json = true;
		} else {
			if(!$_SESSION["add"]) {
				$query = mysql_query("INSERT INTO `category` VALUE
				(null				
				, '".$_POST["name"]."'
				, '".$_POST["description"]."')");
				
				$json = true;
				$_SESSION["add"] = $json;
			} else {
				$json = false;
				$_SESSION["add"] = null;
			}
		}		
		echo json_encode($json);
		
	} break;
	
	case "del-category":{
		
		$query = mysql_query("DELETE FROM `category` WHERE `id_category` = '".$_POST["id_category"]."'");		
		$json = true;
		
		echo json_encode($json);
		
	} break;
	
	default: echo json_encode(false); break;
}
?>