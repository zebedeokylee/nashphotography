<?php
 if(!isset($_SESSION)) 
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: customerPhotosLogin.php");
 } 	 

 //Redirect if not admin
 if(!$_SESSION["adminPermission"]) {
	$_SESSION["status"] = "You do not have admin permission to view the customer admin page";
 	header("Location: customerPhotos.php");	
 }

 //Select Page
 $_SESSION["selectedPage"] = "customerPhotos";
 
 //Check status 
 $status = "";
 if(isset($_SESSION["status"])) {
 	$status = $_SESSION["status"];
	unset($_SESSION["status"]);
 }
  
 print_r($_SESSION);
?>

<html>
 <head>
  <title>Nash Photography - Admin</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  
  <a href="handlers/createNewCustomerHandler.php"><img class="newCustomerIcon" src="add.png" title="Create New Customer"/></a>
  
  <?php 
   require_once("Dao.php");
   require_once("navigation.php");
   
   $dao = new Dao();
   $customers = $dao->getCustomers();    
   if($status != "") {
     echo "<div class=\"errorMessage\">$status</div>";
   }
  ?>
  
   <div class="customerProfiles center"> 
   <?php
    //Print customer info
    foreach($customers as $customer) {
     echo "<div> <div> <form action=\"handlers/viewCustomerPhotosHandler.php\">";
	 $customerPhotos = $dao->getCustomerPhotos($customer["id"]);
	 if(sizeof($customerPhotos) == 0) {
		$customerPhotoPath = "photos/noPhoto.jpg";
	 } else {
	 	$customerPhotoPath = $customerPhotos[0];     
 	 }
	 echo "<input type=\"image\" title=\"View Customer Photos\" class=\"customerProfilePicture\" src=\"$customerPhotoPath\" name=\"customerId\" value=\"" . $customer["id"] . "\"></form></div>";
 	 echo "<div class=\"customerName\">" . htmlentities($customer["firstName"]) . " " . htmlentities($customer["lastName"]);
	 echo "<form action=\"handlers/editCustomerInfoHandler.php\">";
	 echo "<input type=\"image\" title=\"Edit Customer Info\" class=\"addIcon\" src=\"add.png\" name=\"customerId\" value=\"" . $customer["id"] . "\"> </form></div></div>";
    }   
  ?>
  </div>

  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

