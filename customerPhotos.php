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
  <title>Nash Photography</title>
  <?php 
   require_once("Dao.php");
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  <?php 
   require_once("navigation.php");
  ?>

  <div class="slideShow">
   <div><img class="selectedSlide" src="photos/main.jpg"></div>

   <?php
    $dao = new Dao();
    $gallery = $dao -> getCustomerPhotos($_SESSION["loadCustomerId"]);    
    
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
