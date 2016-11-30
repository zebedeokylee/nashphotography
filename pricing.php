<?php
 if(!isset($_SESSION))
	session_start();
 
 $_SESSION["selectedPage"] = "pricing";

?>

<html>
 <head>
  <title>Nash Photography - Pricing</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="yellowBackground">
  <?php 
   require_once("navigation.php");
  ?>

  <div class="info">
    
   <h2>Family Session</h2>
   <div>$350</div>
   <div>1 Hour Shooting</div>
   <div>30+ High Resolution Images</div>
   
   <h2>Senior Session</h2>
   <div>$350</div>
   <div>1 Hour Shooting</div>
   <div>30+ High Resolution Images</div>

   <h2>Family</h2>
   <div>$350</div>
   <div>1 Hour Shooting</div>
   <div>30+ High Resolution Images</div>

   <h2>Wedding</h2>
   <div>$2000</div>
   <div>1 Hour Engagement Session</div>
   <div>6 Hour Wedding Coverage</div>
   
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

