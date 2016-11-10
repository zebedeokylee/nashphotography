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
 print_r($_SESSION); 
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

  <div class="slideShow">
   <div><img class="selectedSlide" src="photos/main.jpg"></div>

   <?php
    $dao = new Dao();
    $gallery = $dao -> getCustomerPhotos($customerId);    
    
    $_SESSION["gallerySize"] = sizeof($gallery);
 	if(!isset($_SESSION["slideShowIndex"])) {
		$_SESSION["slideShowIndex"] = 0;
	}

    echo "<ul class=\"slides\">";
    echo "<li> <form action=\"handlers/leftArrowHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"LeftArrow.png\"></form></li>";
    echo "<li> <img class=\"slide\" src=\"" . $gallery[$_SESSION["slideShowIndex"]] . "\"</li>";
   ?>

    <li><img class="slide" src="photos/main.jpg"></li>
    <li><img class="slide" src="photos/main.jpg"></li>
    <li><img class="arrow" src="RightArrow.png"></li>
   </ul>
  </div>
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>
