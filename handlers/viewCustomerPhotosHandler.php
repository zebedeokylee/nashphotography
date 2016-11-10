<?php
 if(!isset($_SESSION))
	session_start();

 if(isset($_GET["customerId"]) && isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
	$_SESSION["loadCustomerId"] = $_GET["customerId"]; 
 	header("Location: customerPhotosHandler.php");	
	exit;
 } else {
	$_SESSION["status"] = "You do not have permission to view customer photos or the customer id is not set";
 	header("Location: ../customerPhotosAdmin.php");	
	exit;
 }

?>

