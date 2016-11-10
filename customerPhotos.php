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
 </head>

 <body class="greenBackground">
  <?php
   echo "<form  action=\"handlers/downloadPhotosHandler.php\">";
   echo "<input title=\"Download photos\" type=\"image\" id=\"downloadLink\" src=\"download.png\" name=\"customerId\" value=\"" . $customerId . "\"></form>";
   require_once("navigation.php");
   
   if($status != "") {
     echo "<div class=\"errorMessage\">$status</div>";
   }
  ?>

   <?php
    $dao = new Dao();
    $gallery = $dao -> getCustomerPhotos($customerId);    
	$_SESSION["customerGallerySize"] = sizeof($gallery);
 	if(!isset($_SESSION["customerGalleryIndex1"])) {
		$_SESSION["customerGalleryIndex1"] = 0;
		$_SESSION["customerGalleryIndex2"] = 1;
		$_SESSION["customerGalleryIndex3"] = 2;
	}
    $noPhotoPath = "photos/noPhoto.jpg";
	echo "<div class=\"slideShow\">";
    echo "<div><img class=\"selectedSlide\" src=\"";
	echo (sizeof($gallery) == 0) ? $noPhotoPath : $gallery[0];
	echo "\"></div>";
    echo "<ul class=\"slides\">";
    echo "<li> <form action=\"handlers/leftArrowCustomerHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"LeftArrow.png\"/></form></li>";
	
	//Slide 1
	echo "<li> <img class=\"slide\" src=\"";
	echo (sizeof($gallery) == 0) ? $noPhotoPath : $gallery[$_SESSION["customerGalleryIndex1"]];
	echo "\"</li>";
    
	//Slide 2
	echo "<li> <img class=\"slide\" src=\"";
	echo (sizeof($gallery) <= 1) ? $noPhotoPath : $gallery[$_SESSION["customerGalleryIndex2"]];
	echo "\"</li>";

	//Slide 3
	echo "<li> <img class=\"slide\" src=\"";
	echo (sizeof($gallery) <= 2) ? $noPhotoPath : $gallery[$_SESSION["customerGalleryIndex3"]];
	echo "\"</li>";

    echo "<li> <form action=\"handlers/RightArrowCustomerHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"RightArrow.png\"/></form></li>";
   ?>
   </ul>
  </div>
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>
