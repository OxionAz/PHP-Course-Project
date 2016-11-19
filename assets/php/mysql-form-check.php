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
	
	default: echo json_encode(false); break;
}
?>