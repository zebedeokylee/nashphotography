<?php
 if(!isset($_SESSION))
	session_start();
 
 //Select Page
 $_SESSION["selectedPage"] = "";
  
?>

<html>
 <head>
  <title>Nash Photography</title>
  <?php 
   include("links.php");
  ?>
 </head>

 <body class="imageBackground">
  <?php 
   require_once("navigation.php");
  ?>

 </body>

</html>
