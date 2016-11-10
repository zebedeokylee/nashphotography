<?php
 if(!isset($_SESSION))
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: customerPhotosLogin.php");
    exit;
 } 	 

 //Redirect if not admin
 if(!$_SESSION["adminPermission"]) {
	$_SESSION["status"] = "You do not have permission to edit customers.";
 	header("Location: customerPhotos.php");	
    exit;
 }

 //Select Page
 $_SESSION["selectedPage"] = "customerPhotos";
 
 //Check status 
 $status = "";
 if(isset($_SESSION["status"])) {
 	$status = $_SESSION["status"];
	unset($_SESSION["status"]);
 }
  
?>

<html>
 <head>
  <title>Nash Photography - Edit Customer</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  <a href="handlers/createNewCustomerHandler.php"><img class="newCustomerIcon" src="add.png" title="Create New Customer"/></a>
  
  <?php 
   require_once("Dao.php");
   require_once("navigation.php");

   $customerId = "";
   $customerUsername = "";
   $customerFirstName = "";
   $customerLastName = "";
   $customerIsActive = "";

   //Editing a customer
   if(isset($_SESSION["loadCustomerId"])) {
    $customerId = $_SESSION["loadCustomerId"];
    
    //Get the already existing info for the customer
	$dao = new Dao();

    try{
		$customerInfo = $dao->getCustomer($customerId);
	} catch(Exception $e) {
		$_SESSION["status"] = "Error when getting customer " . $customerId . " info: " . $e->getMessage();
 		header("Location: customerPhotos.php");	
    	exit;
	}

    $customerUsername = $customerInfo["username"];
    $customerFirstName = $customerInfo["firstName"];
    $customerLastName = $customerInfo["lastName"];
    $customerIsActive = $customerInfo["isActive"];
   } else { 
   	if(isset($_SESSION["customerId"])) {
 	 $customerId = $_SESSION["customerId"]; 
   	}
   	if(isset($_SESSION["customerUsername"])) {
 	 $customerUsername = $_SESSION["customerUsername"]; 
   	}
   	if(isset($_SESSION["customerPassword"])) {
 	 $customerPassword = $_SESSION["customerPassword"]; 
   	}
   	if(isset($_SESSION["customerFirstName"])) {
 	 $customerFirstName = $_SESSION["customerFirstName"]; 
   	}
   	if(isset($_SESSION["customerLastName"])) {
 	 $customerLastName = $_SESSION["customerLastName"]; 
   	}
   	if(isset($_SESSION["customerIsActive"])) {
 	 $customerIsActive = $_SESSION["customerIsActive"]; 
   	}
   }

   	//Get all status messages
   	$customerUsernameStatus = "";
   	$customerPasswordStatus = "";
	$customerFirstNameStatus = "";
	$customerLastNameStatus = "";
	$customerUpdateStatus = "";
	$customerPhotosStatus = "";
	$customerUpdateConfirmation = "";
	$customerPhotosConfirmation = "";

   	if(isset($_SESSION["customerUsernameStatus"])) {
 	 $customerUsernameStatus = $_SESSION["customerUsernameStatus"]; 
   	}
   	if(isset($_SESSION["customerPasswordStatus"])) {
 	 $customerPasswordStatus = $_SESSION["customerPasswordStatus"]; 
   	}
   	if(isset($_SESSION["customerFirstNameStatus"])) {
 	 $customerFirstNameStatus = $_SESSION["customerFirstNameStatus"]; 
   	}
   	if(isset($_SESSION["customerLastNameStatus"])) {
 	 $customerLastNameStatus = $_SESSION["customerLastNameStatus"]; 
   	}
   	if(isset($_SESSION["customerUpdateStatus"])) {
 	 $customerUpdateStatus = $_SESSION["customerUpdateStatus"]; 
   	}
   	if(isset($_SESSION["customerPhotosStatus"])) {
 	 $customerPhotosStatus = $_SESSION["customerPhotosStatus"]; 
   	}
   	if(isset($_SESSION["customerUpdateConfirmation"])) {
 	 $customerUpdateConfirmation = $_SESSION["customerUpdateConfirmation"]; 
   	}
   	if(isset($_SESSION["customerPhotosConfirmation"])) {
 	 $customerPhotosConfirmation = $_SESSION["customerPhotosConfirmation"]; 
   	}

  ?>

  <form class="login" action="handlers/saveCustomerInfoHandler.php" method="POST" enctype="multipart/form-data">
   <div>
	<label for="id">Id: <?php echo $customerId; ?></label>
   </div>
   <div>
	<label for="customerUsername">Username: </label>
    <input type="text" name="customerUsername" id="customerUsername" value="<?php echo htmlentities($customerUsername); ?>"/>
    <div class="errorMessage"><?php echo $customerUsernameStatus;?></div>
   </div>
   <div>
   <div>
    <label for="customerPassword"><?php echo ($customerId == 0 ? "Password:" : "Reset Password:"); ?></label>
    <input type="password" name="customerPassword" id="customerPassword" value="">
    <div class="errorMessage"><?php echo $customerPasswordStatus;?></div>
   </div>
   <div>
	<label for="customerFirstName">First Name: </label>
    <input type="text" name="customerFirstName" id="customerFirstName" value="<?php echo htmlentities($customerFirstName); ?>"/>
    <div class="errorMessage"><?php echo $customerFirstNameStatus;?></div>
   </div>
   <div>
	<label for="customerLastName">Last Name: </label>
    <input type="text" name="customerLastName" id="customerLastName" value="<?php echo htmlentities($customerLastName); ?>"/>
    <div class="errorMessage"><?php echo $customerLastNameStatus;?></div>
   </div>
   <div>
	<label for="customerIsActive">Active: </label>
    <input type="checkBox" name="customerIsActive" id="customerIsActive" <?php echo ($customerIsActive ? "checked" : ""); ?>/>
   </div>   
   <div>
	<label for="file">Upload Photos: </label>
    <input type="file" name="file" id="file" multiple/>
   </div>   
   <div>
    <input type="submit" value="Save"/>
    <div class="errorMessage"><?php echo $customerUpdateStatus;?></div>
    <div class="errorMessage"><?php echo $customerPhotosStatus;?></div>
    <div class="confirmationMessage"><?php echo $customerUpdateConfirmation;?></div>
    <div class="confirmationMessage"><?php echo $customerPhotosConfirmation;?></div>
   </div>
  </form>
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

