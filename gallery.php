<?php
 if(!isset($_SESSION))
	session_start();
 
 //Select Page
 $_SESSION["selectedPage"] = "gallery";
  
?>

<html>
 <head>
  <title>Nash Photography - Gallery</title>
  <?php
   require_once("links.php");
  ?>
 </head>

 <body class="pinkBackground">
  <?php 
   require_once("Dao.php");
   require_once("navigation.php"); 
  ?>
  
   <?php
    $dao = new Dao();
    

	try {
		$gallery = $dao -> getGalleryPhotos();    
	} catch(Exception $e) {
		echo "<div class=\"errorMessage\">Error when getting gallery photos </div>";
	}
	
	$_SESSION["gallerySize"] = sizeof($gallery);
 	if(!isset($_SESSION["galleryIndex1"])) {
		$_SESSION["galleryIndex1"] = 0;
		$_SESSION["galleryIndex2"] = 1;
		$_SESSION["galleryIndex3"] = 2;
	}
  	echo "<div class=\"slideShow\">";
  	echo "<div><img class=\"selectedSlide\" src=\"" . htmlentities($gallery[0]) . "\"></div>";

    echo "<ul class=\"slides\">";
    echo "<li> <form action=\"handlers/leftArrowHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"LeftArrow.png\"/></form></li>";
    echo "<li> <img class=\"slide\" src=\"" . htmlentities($gallery[$_SESSION["galleryIndex1"]]) . "\"</li>";
    echo "<li> <img class=\"slide\" src=\"" . htmlentities($gallery[$_SESSION["galleryIndex2"]]) . "\"</li>";
    echo "<li> <img class=\"slide\" src=\"" . htmlentities($gallery[$_SESSION["galleryIndex3"]]) . "\"</li>";
    echo "<li> <form action=\"handlers/rightArrowHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"RightArrow.png\"/></form></li>";
   ?>
   </ul>
  </div>

  <?php
    require_once("footer.php");
  ?>
 </body>

</html>

