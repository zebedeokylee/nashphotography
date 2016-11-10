<?php
 if(!isset($_SESSION))
	session_start();

 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: ../customerPhotosLogin.php");
    exit;
 } 	 
 
 //Redirect if not admin
 if(!$_SESSION["adminPermission"]) {
	$_SESSION["status"] = "You do not have admin permission to view the customer admin page";
 	header("Location: ../customerPhotos.php");	
 }
 
 if(isset($_GET["customerId"]) && isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
    $_SESSION["loadCustomerId"] = $_GET["customerId"];
    
	//Clear all status
 	if(isset($_SESSION["customerUsernameStatus"])) {
    	unset($_SESSION["customerUsernameStatus"]);
 	}
 	if(isset($_SESSION["customerPasswordStatus"])) {
    	unset($_SESSION["customerPasswordStatus"]);
 	}
 	if(isset($_SESSION["customerFirstNameStatus"])) {
    	unset($_SESSION["customerFirstNameStatus"]);
 	}
 	if(isset($_SESSION["customerLastNameStatus"])) {
    	unset($_SESSION["customerLastNameStatus"]);
 	}
 	if(isset($_SESSION["customerUpdateStatus"])) {
    	unset($_SESSION["customerUpdateStatus"]);
 	}
 	if(isset($_SESSION["customerPhotosStatus"])) {
    	unset($_SESSION["customerPhotosStatus"]);
 	}
 	if(isset($_SESSION["customerUpdateConfirmation"])) {
    	unset($_SESSION["customerUpdateConfirmation"]);
	}
 	if(isset($_SESSION["customerPhotosConfirmation"])) {
    	unset($_SESSION["customerPhotosConfirmation"]);
 	}
   	header("Location: ../editCustomer.php");
	exit;
 } else {
	if(!isset($_GET["customerId"])) {
		$_SESSION["status"] = "Customer to load was not found. ";
	} 
    
    if(!isset($_SESSION["adminPermission"]) || !$_SESSION["adminPermission"]) {
		$_SESSION["status"] .= "You do not have permission to edit customer info.";	
		header("Loaction: customerPhotos.php");
		exit;
	}

	header("Location: customerPhotosAdmin.php");	
 }

?>

