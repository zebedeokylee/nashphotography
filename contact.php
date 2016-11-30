<?php
 if(!isset($_SESSION))
	session_start();

 $_SESSION["selectedPage"] = "contact";
?>

<html>
 <head>
  <title>Nash Photography - Contact</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="orangeBackground">
  <?php 
   require_once("navigation.php");
  ?>

  <div class="info">

   <h2>Phone</h2>
   <div>(xxx)-xxx-xxxx</div>
 
   <h2>Email</h2>
   <div>email@email.com</div>  

   <h2>Loaction</h2>
   <div>xxxx street address</div>
   <div>Boise, ID 83706</div>
  <div> 
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

