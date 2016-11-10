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
	$_SESSION["status"] = "You do not have admin permission to create a new customer";
 	header("Location: ../customerPhotos.php");	
 }
 
 if(isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
    if(isset($_SESSION["customerId"]))
		unset($_SESSION["customerId"]);
    if(isset($_SESSION["loadCustomerId"]))
		unset($_SESSION["loadCustomerId"]);
 
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

	//Clear all presets
   	if(isset($_SESSION["customerId"])) {
 	 $customerId = $_SESSION["customerId"]; 
   	}
   	if(isset($_SESSION["customerUsername"])) {
 	 $customerUsername = $_SESSION["customerUsername"]; 
	   unset($_SESSION["customerUsername"]);
   	}
   	if(isset($_SESSION["customerPassword"])) {
 	 $customerPassword = $_SESSION["customerPassword"]; 
     unset($_SESSION["customerPassword"]);
   	}
   	if(isset($_SESSION["customerFirstName"])) {
 	 $customerFirstName = $_SESSION["customerFirstName"]; 
     unset($_SESSION["customerFirstName"]);
   	}
   	if(isset($_SESSION["customerLastName"])) {
 	 $customerLastName = $_SESSION["customerLastName"]; 
     unset($_SESSION["customerLastName"]);
   	}
   	if(isset($_SESSION["customerIsActive"])) {
 	 $customerIsActive = $_SESSION["customerIsActive"]; 
     unset($_SESSION["customerIsActive"]);
   	}







	header("Location: ../editCustomer.php");
 }    

