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
  <script src="slider.js"></script> 
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
   
	echo "<div class=\"demo\">";
    echo " <div class=\"item\">";            
    echo "  <div class=\"clearfix\" >";
    echo "   <ul id=\"image-gallery\" class=\"gallery list-unstyled cS-hidden\">";
    foreach($gallery as $photo) {
		echo "    <li data-thumb=\"" . htmlentities($photo) . "\">";
    	echo "     <img src=\"" . htmlentities($photo) . "\" />";
    	echo "    </li>";
   	} 
	echo "   </ul>";
    echo "  </div>";
    echo " </div>";

    require_once("footer.php");
  ?>
 </body>

</html>

