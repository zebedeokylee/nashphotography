<?php
 if(!isset($_SESSION))
	session_start();
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
//   require_once("subnavigation.php"); 
  ?>
  
  <div class="slideShow">
   <div><img class="selectedSlide" src="photos/main.jpg"></div>
   

   <?php
    $dao = new Dao();
    $gallery = $dao -> getGalleryPhotos();    
    
    $_SESSION["gallerySize"] = sizeof($gallery);
 	if(!isset($_SESSION["slideShowIndex"])) {
		$_SESSION["slideShowIndex"] = 0;
	}

    print_r($gallery);
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

