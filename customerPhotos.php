<?php
 if(!isset($_SESSION))
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: customerPhotosLogin.php");
 	exit;
 } 	 

 //Redirect if admin but no customer login id set   
 if($_SESSION["adminPermission"] && !isset($_SESSION["loadCustomerId"])) {
	$_SESSION["status"] = "You must select a customer photo below to view the customer photos page.";
	header("Location: customerPhotosAdmin.php");
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

 //Find customer id to load
 $customerId = $_SESSION["adminPermission"] ? $_SESSION["loadCustomerId"] : $_SESSION["userId"]; 
?>

<html>
 <head>
  <title>Nash Photography</title>
  <?php 
   require_once("Dao.php");
   require_once("links.php");
  ?>
  <script src="slider.js"></script> 
 </head>

 <body class="greenBackground">
  <?php
   echo "<form  action=\"handlers/downloadPhotosHandler.php\">";
   echo "<input title=\"Download photos\" type=\"image\" id=\"downloadLink\" src=\"download.png\" name=\"customerId\" value=\"" . $customerId . "\"></form>";
   require_once("navigation.php");
  
   //display status 
   if($status != "") {
     echo "<div class=\"errorMessage\">$status</div>";
   }
  ?>

   <?php
    $dao = new Dao();
    $gallery = $dao -> getCustomerPhotos($customerId);    

	echo "<div class=\"demo\">";
    echo " <div class=\"item\">";            
    echo "  <div class=\"clearfix\" >";
    echo "   <ul id=\"image-gallery\" class=\"gallery list-unstyled cS-hidden\">";
    foreach($gallery as $photo) {
		echo "    <li data-thumb=\"" . htmlentities($photo) . "\">";
    	echo "     <img src=\"" . htmlentities($photo) . "\" />";
    	echo "    </li>";
   	}
	if(sizeof($gallery) == 0) {
    	$noPhotoPath = "photos/noPhoto.jpg";
		echo "    <li data-thumb=\"" . $noPhotoPath . "\">";
    	echo "     <img src=\"" . $noPhotoPath . "\" />";
    	echo "    </li>";
	} 
	echo "   </ul>";
    echo "  </div>";
    echo " </div>";
	
   require_once("footer.php");
  ?>
 </body>

</html>
