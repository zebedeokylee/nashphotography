<?php
 if(!isset($_SESSION))
	session_start();
 
 if(isset($_SESSION["gallerySize"])) {
 	if(!isset($_SESSION["galleryIndex1"])) {
		$_SESSION["galleryIndex1"] = 0;
	}

	$_SESSION["galleryIndex1"] -= 3;
    if($_SESSION["galleryIndex1"] < 0) {
   		$_SESSION["galleryIndex1"] += $_SESSION["gallerySize"];
	}


 	if(!isset($_SESSION["galleryIndex2"])) {
		$_SESSION["galleryIndex2"] = 1;
	}

	$_SESSION["galleryIndex2"] -= 3;
    if($_SESSION["galleryIndex2"] < 0) {
   		$_SESSION["galleryIndex2"] += $_SESSION["gallerySize"];
	}
 	

	if(!isset($_SESSION["galleryIndex3"])) {
		$_SESSION["galleryIndex3"] = 2;
	}

	$_SESSION["galleryIndex3"] -= 3;
    if($_SESSION["galleryIndex3"] < 0) {
   		$_SESSION["galleryIndex3"] += $_SESSION["gallerySize"];
	}

 }

 header("Location: ../gallery.php");

