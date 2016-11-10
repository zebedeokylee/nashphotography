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
	$_SESSION["status"] = "You do not have admin permission to update customer information.";
 	header("Location: ../customerPhotos.php");	
 }
 
 require_once("../Dao.php");
     
 //Get posted info
 $customerId = "";
 if(isset($_SESSION["loadCustomerId"])) { 
	$customerId = $_SESSION["loadCustomerId"];
 } else if(isset($_SESSION["customerId"])) { 
	$customerId = $_SESSION["customerId"];
	unset($_SESSION["customerId"]);
 }
 $customerUsername = $_POST["customerUsername"];
 $customerPassword = isset($_POST["customerPassword"]) ? $_POST["customerPassword"] : "";
 $customerFirstName = $_POST["customerFirstName"];
 $customerLastName = $_POST["customerLastName"];
 $customerIsActive = isset($_POST["customerIsActive"]) ? 1 : 0;
     
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

 //Checks on all these
 $usernameRegex = '/^[a-zA-Z1-9]{1,}$/';	
 if(!preg_match($usernameRegex, $customerUsername)) {
	$_SESSION["customerUsernameStatus"] = "Invalid username - must only contain letters or digits";
 }
 $nameRegex = '/^[a-zA-Z]{1,}$/';	
 if(!preg_match($nameRegex, $customerFirstName)) {
	$_SESSION["customerFirstNameStatus"] = "Invalid first name - must contain only letters";
 }
 if(!preg_match($nameRegex, $customerLastName)) {
	$_SESSION["customerLastNameStatus"] = "Invalid last name - must contain only letters";
 }
 if($customerId == "" || $customerPassword != "") {
  	$passwordRegex = '/^[a-zA-Z1-9]{6,}$/';  //TODO: come up with a better regex here
 	if(!preg_match($passwordRegex, $customerPassword)) {
		$_SESSION["customerPasswordStatus"] = "Invalid password - must contain only letters and/or digits and be at least 6 characters.";
 	}
 }
		
 //Check username is unique
 $dao = new Dao();
 $existingCustomerWithUsername = $dao->getCustomerByUsername($customerUsername);
 if(sizeof($existingCustomerWithUsername) != 0 && $customerId != $existingCustomerWithUsername["id"]) {
 	if(!isset($_SESSION["customerUsernameStatus"]) || $_SESSION["customerUsernameStatus"] == "") {
		$_SESSION["customerUsernameStatus"] = "Invalid username - this username is alread in use. Choose another username";
	} else {
		$_SESSION["customerUsernameStatus"] .= " and this username is alread in use.  Choose another username";
	}	
 }

 //If there were erros in input, return those error messages to the user
 if(isset($_SESSION["customerUsernameStatus"]) || isset($_SESSION["customerFirstNameStatus"]) || isset($_SESSION["customerLastNameStatus"]) || isset($_SESSION["passwordStatus"])) {   
 	unset($_SESSION["loadCustomerId"]);   //We don't want to reload the customer info, we want to use the saved values the user entered in 
	$_SESSION["customerId"] = $customerId;
 	$_SESSION["customerUsername"] = $customerUsername;
 	$_SESSION["customerPassword"] = $customerPassword;
 	$_SESSION["customerFirstName"] = $customerFirstName;
 	$_SESSION["customerLastName"] = $customerLastName;
 	$_SESSION["customerIsActive"] = $customerIsActive;
	header("Location: ../editCustomer.php");	
	exit;
 }
	

 //Save Customer Info    
 if($customerId == "") {
  	try {
 		$dao->insertCustomer($customerUsername, $customerPassword, $customerFirstName, $customerLastName, $customerIsActive);
    	$customerId = $dao->getCustomerIdByUsername($customerUsername);
    	$_SESSION["customerId"] = $customerId;
		$_SESSION["customerUpdateConfirmation"] = "Customer created";
 	} catch (Exception $e) {
		$_SESSION["customerUpdateStatus"] = "Error creating new customer: " . $e->getMessage();
		header("Location: editCustomer.php"); //Want to redirect since we need the customer created correctly in order to save the pictures later on in the script
		exit;
 	}
 } else {
	try {
      	$dao->saveCustomerInfo($customerId, $customerUsername, $customerFirstName, $customerLastName, $customerIsActive);
		if($customerPassword != "") {
			$dao->updatePassword($customerId, $customerPassword);
		}
		$_SESSION["customerUpdateConfirmation"] = "Any changes to customer info were saved";
    } catch (Exception $e) {
	  	$_SESSION["customerUpdateStatus"] = "Error unable to save customer info updates: " . $e->getMessage();
    }
 }

 //Save Pictures
 if(count($_FILES) > 0) {
 	if($_FILES["file"]["error"] > 0) {
		if($_FILES["file"]["error"] != 4) { //this error occurs when no file is uploaded which is okay
			$_SESSION["customerPhotosStatus"] = "Error: " . $_FILES["file"]["error"];
 		}
    } else {
	  	$basePath = "../photos/customerPhotos/";
		if (!file_exists($basePath . $customerId)) {
    		mkdir($basePath. $customerId, 0777, true);
		}
      	$filePath = $customerId . "/" . $_FILES["file"]["name"];
      	if(move_uploaded_file($_FILES["file"]["tmp_name"], $basePath . $filePath)) {
      		$_SESSION["customerPhotosConfirmation"] = "Photos were saved"; 
		} else {
	  		$_SESSION["customerPhotosStatus"] = "Photos were not saved";
      	}
    } 
 }
 
 $_SESSION["loadCustomerId"] = $customerId;
 header("Location: ../editCustomer.php");
 exit;

?>


