<?php
 if(!isset($_SESSION))
	session_start();

 if(isset($_GET["customerId"]) && isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
   	//echo $_GET["customerId"];
	$_SESSION["loadCustomerId"] = $_GET["customerId"]; 
   	header("Location: ../customerPhotos.php");
 } else {
	//TODO: Add error handling
 }

?>

