<?php
 if(!isset($_SESSION))
	session_start();
 
 if(isset($_SESSION["customerGallerySize"])) {
	if($_SESSION["customerGallerySize"] <= 3) {
		header("Location: ../customerPhotos.php");
		exit;
	}
 	
	if(!isset($_SESSION["customerGalleryIndex1"])) {
		$_SESSION["customerGalleryIndex1"] = 0;
	}

	$_SESSION["customerGalleryIndex1"] += 3;
    if($_SESSION["customerGalleryIndex1"] >= $_SESSION["customerGallerySize"]) {
   		$_SESSION["customerGalleryIndex1"] -= $_SESSION["customerGallerySize"];
	}


 	if(!isset($_SESSION["customerGalleryIndex2"])) {
		$_SESSION["customerGalleryIndex2"] = 1;
	}

	$_SESSION["customerGalleryIndex2"] += 3;
    if($_SESSION["customerGalleryIndex2"] >= $_SESSION["customerGallerySize"]) {
   		$_SESSION["customerGalleryIndex2"] -= $_SESSION["customerGallerySize"];
	}
 	

	if(!isset($_SESSION["customerGalleryIndex3"])) {
		$_SESSION["customerGalleryIndex3"] = 2;
	}

	$_SESSION["customerGalleryIndex3"] += 3;
    if($_SESSION["customerGalleryIndex3"] >= $_SESSION["customerGallerySize"]) {
   		$_SESSION["customerGalleryIndex3"] -= $_SESSION["customerGallerySize"];
	}

 }

 header("Location: ../customerPhotos.php");

