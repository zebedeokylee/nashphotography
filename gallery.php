<html>
 <head>
  <title>Nash Photography - Gallery</title>
  <?php
   require_once("links.php");
  ?>
 </head>

 <body class="pinkBackground">
  <?php 
   require_once("navigation.php"); 
   require_once("subnavigation.php"); 
  ?>

  <div class="center">
   <img class="selectedSlide" src="photos/main.jpg">
   
   <ul class="slideShow">
    <li><img class="slide" src="photos/main.jpg"></li>
    <li><img class="slide" src="photos/main.jpg"></li>
    <li><img class="slide" src="photos/main.jpg"></li>
   </ul>
  </div>

  <?php
    require_once("footer.php");
  ?>
 </body>

</html>

