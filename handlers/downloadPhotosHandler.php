<?php
 if(!isset($_SESSION))
	session_start();
 
 //Redirect if not logged in 
 if(isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] || !isset($_SESSION["loggedIn"])) {
	$_SESSION["status"] = "You must log in first";
	header("Location: ../customerPhotosLogin.php");
    exit;
 } 	 
 
 //Redirect if no customer id set
 if(!isset($_GET["customerId"])) {
	$_SESSION["status"] = "Customer id could not be found";
 	header("Location: ../customerPhotos.php");	
	exit;
 }
 
 //Redirect if not admin or user
 if(!$_SESSION["adminPermission"] && $_SESSION["userId"] != $_GET["customerId"]) {
	$_SESSION["status"] = "You do not have admin permission to view the customer admin page";
 	header("Location: ../customerPhotos.php");	
	exit;
 }

 //Check that customer has photos
 require_once("../Dao.php");
 $dao = new Dao();
 $photos = $dao->getCustomerPhotos($_GET["customerId"], "../");
 if(sizeof($photos) == 0) {
	$_SESSION["status"] = "There are no photos to download";
 	header("Location: ../customerPhotos.php");	
	exit;
 }

 //if exists, delete
 $zipPath = "../photos/customerPhotos/" . $_GET["customerId"] . "/nashPhotography.zip";

 //code from https://akrabat.com/creating-a-zip-file-with-phps-ziparchive/
 $zip = new ZipArchive();
 $zip->open($zipPath, ZipArchive::CREATE);
 
 foreach($photos as $photo) {
  $zip->addFile($photo, basename($photo));
 }
 $zip->close();
 
 $filename = $zipPath;
 $name = basename($filename);
 $finfo = finfo_open(FILEINFO_MIME_TYPE);
 $mimeType = finfo_file($finfo, $filename);
 $size = filesize($filename);
 
 if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  header('Cache-Control: max-age=120');
  header('Pragma: public');
 } else {
  header('Cache-Control: private, max-age=120, must-revalidate');
  header("Pragma: no-cache");
 }
 header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // long ago
 header("Content-Type: $mimeType");
 header('Content-Disposition: attachment; filename="' . $name . '";');
 header("Accept-Ranges: bytes");
 header('Content-Length: ' . filesize($filename));
 
 print readfile($filename);
 exit;

