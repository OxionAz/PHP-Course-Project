<?php

function checkUserLogin($login){
	return preg_match("/^[\-_A-Za-z0-9]+$/i", $login);
}

function checkUserEmail($email){
	return preg_match("/^[\.\-_A-Za-z0-9]+@[\.\-A-Za-z0-9]+\.[A-Za-z]{2,6}$/i", $email);
}

function checkUserPassword($password){
	return preg_match("/^[\-_A-Za-z0-9]+$/i", $password);
}

?>