<?php
 if(!isset($_SESSION))
	session_start();

 if(isset($_GET["customerId"]) && isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
	$_SESSION["loadCustomerId"] = $_GET["customerId"]; 
   	header("Location: ../editCustomer.php");
 } else {
	//TODO: Add error handling
 }

?>

