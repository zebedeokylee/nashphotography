<?php
 if(!isset($_SESSION))
	session_start();
 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: ../customerPhotosLogin.php");
 } 	 

?>
