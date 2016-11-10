<?php
 if(!isset($_SESSION))
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: ../customerPhotosLogin.php");
 	exit;
 } 	 

 //Redirect if admin but no customer login id set   
 if($_SESSION["adminPermission"] && !isset($_SESSION["loadCustomerId"])) {
	$_SESSION["status"] = "You must select a customer photo below to view the customer photos page.";
	header("Location: ../customerPhotosAdmin.php");
    exit;
 }

 //Reset variables for slide show
 if(isset($_SESSION["customerGallerySize"])) { 
	unset($_SESSION["customerGallerySize"]);
 }
 if(isset($_SESSION["customerGalleryIndex1"])) { 
	unset($_SESSION["customerGalleryIndex1"]);
 }
 if(isset($_SESSION["customerGalleryIndex2"])) { 
	unset($_SESSION["customerGalleryIndex2"]);
 }
 if(isset($_SESSION["customerGalleryIndex3"])) { 
	unset($_SESSION["customerGalleryIndex3"]);
 }

 header("Location: ../customerPhotos.php");

