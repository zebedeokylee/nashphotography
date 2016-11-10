<?php
 if(!isset($_SESSION))
	session_start();
 
 //Select Page
 $_SESSION["selectedPage"] = "gallery";
  
 print_r($_SESSION);
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
    $gallery = $dao -> getGalleryPhotos();    
    
	$_SESSION["gallerySize"] = sizeof($gallery);
 	if(!isset($_SESSION["slideShowIndex"])) {
		$_SESSION["slideShowIndex"] = 0;
	}
  	echo "<div class=\"slideShow\">";
  	echo "<div><img class=\"selectedSlide\" src=\"" . $gallery[0] . "\"></div>";

    echo "<ul class=\"slides\">";
    echo "<li> <form action=\"handlers/leftArrowHandler.php\">";
	echo "<input type=\"image\" class=\"arrow\" src=\"LeftArrow.png\"/></form></li>";
    echo "<li> <img class=\"slide\" src=\"" . $gallery[$_SESSION["slideShowIndex"]] . "\"</li>";
    echo "<li> <img class=\"slide\" src=\"" . $gallery[$_SESSION["slideShowIndex"] + 1] . "\"</li>";
    echo "<li> <img class=\"slide\" src=\"" . $gallery[$_SESSION["slideShowIndex"] + 2] . "\"</li>";
   ?>
    <li><img class="arrow" src="RightArrow.png"></li>
   </ul>
  </div>

  <?php
    require_once("footer.php");
  ?>
 </body>

</html>

