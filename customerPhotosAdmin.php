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
  <title>Nash Photography - Admin</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  
  <img class="newCustomerIcon" src="add.png" title="Create New Customer"/>
  
  <?php 
   require_once("Dao.php");
   require_once("navigation.php");
   
   $dao = new Dao();
   $customers = $dao->getCustomers();    
  ?>
  
   <div class="customerProfiles center"> 
   <?php
    foreach($customers as $customer) {
     echo "<div> <div> <form action=\"handlers/viewCustomerPhotosHandler.php\">";
	 echo "<input type=\"image\" title=\"View Customer Photos\" class=\"customerProfilePicture\" src=\"photos/main.jpg\" name=\"customerId\" value=\"" . $customer["id"] . "\"></form></div>";
 	 echo "<div class=\"customerName\">" . $customer["firstName"] . " " . $customer["lastName"];
	 echo "<form action=\"handlers/editCustomerInfoHandler.php\">";
	 echo "<input type=\"image\" title=\"Edit Customer Info\" class=\"addIcon\" src=\"add.png\" name=\"customerId\" value=\"" . $customer["id"] . "\"> </form></div></div>";
    }   

    print_r($customers);
  ?>

	 <div>
      <div>
       <img class="customerProfilePicture" src="photos/main.jpg">
      </div>
      <div class="customerName">Customer 1<img class="addIcon" src="add.png">
      </div>
     </div>
     
  </div>

  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

