<?php
 if(!isset($_SESSION))
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: customerPhotosLogin.php");
 } 	 

 print_r($_SESSION);
 
?>

<html>
 <head>
  <title>Nash Photography - Edit Customer</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  <?php 
   require_once("Dao.php");
   require_once("navigation.php");

   $customerId = "";
   $customerUsername = "";
   $customerFirstName = "";
   $cusomterLastName = "";
   $customerIsActive = "";

   if(isset($_SESSION["loadCustomerId"])) {
    $customerId = $_SESSION["loadCustomerId"];
    unset($_SESSION["loadCustomerId"]); //maybe do this somewehere else like in the handler
    $_SESSION["customerId"] = $customerId;
    
    $dao = new Dao();
    $customerInfo = $dao->getCustomer($customerId);
    $customerUsername = $customerInfo["username"];
    $customerFirstName = $customerInfo["firstName"];
    $customerLastName = $customerInfo["lastName"];
    $customerIsActive = $customerInfo["isActive"];
    print_r($customerInfo);
     
   } else {
   	if(isset($_SESSION["customerId"])) {
 	 $customerId = $_SESSION["customerId"]; 
   	}
   	$customerUsername = "";
   	if(isset($_SESSION["customerUsername"])) {
 	 $customerUsername = $_SESSION["customerUsername"]; 
   	}
   }

  ?>

  <form class="login" action="handlers/loginHandler.php" method="POST">
   <div>
	<label for="id">Id: <?php echo $customerId; ?></label>
   </div>
   <div>
	<label for="username">Username: </label>
    <input type="text" name="username" id="username" value="<?php echo $customerUsername; ?>"/>
   </div>
   <div>
   <div>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" value="">
   </div>
   <div>
	<label for="firstName">First Name: </label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $customerFirstName; ?>"/>
   </div>
   <div>
	<label for="lastName">Last Name: </label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $customerLastName; ?>"/>
   </div>
   <div>
	<label for="isActive">Active: </label>
    <input type="checkBox" name="isActive" id="isActive" <?php echo ($customerIsActive ? "checked" : ""); ?>/>
   </div>
   
   <div>
    <input type="submit" value="Login"/>
   </div>
  </form>
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

