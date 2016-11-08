<?php
 if(!isset($_SESSION))
	session_start();
 
 if(isset($_SESSION["gallerySize"])) {
 	if(!isset($_SESSION["slideShowIndex"])) {
		$_SESSION["slideShowIndex"] = 0;
	}

	$_SESSION["slideShowIndex"] -= 3;
    if($_SESSION["slideShowIndex"] < 0) {
   		$_SESSION["slideShowIndex"] += $_SESSION["gallerySize"];
	}
 }

 header("Location: ../gallery.php");

