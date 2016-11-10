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
   <h1>Contact</h1>

   <h2>Phone</h2>
   <p>(xxx)-xxx-xxxx</p>
 
   <h2>Email</h2>
   <p>email@email.com</p>  

   <h2>Loaction</h2>
   <p>xxxx street address</p>
  <div> 
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

