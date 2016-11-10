<?php
 if(!isset($_SESSION))
	session_start();
 
 class Dao {

/*  private $host = "localhost";
  private $db = "nashPhotography";
  private $user = "root";
  private $password = "root";
*/

  private $host = "us-cdbr-iron-east-04.cleardb.net";
  private $db = "heroku_4254fa8ab32f37d";
  private $user = "bd1074010cdff0";
  private $password = "3bdb2b75";

   public function getGalleryPhotos() {
   $galleryPhotos = glob("photos/gallery/*");
   $i = 0;
   $filteredGalleryPhotos = array();
   foreach($galleryPhotos as $photo) {
    if($photo != "." && $photo != "photos/gallery/zipfile.zip") {
 		$filteredGalleryPhotos[$i] = $photo;
		$i++;
	}
   }
   return $filteredGalleryPhotos;
  }

  public function getCustomerPhotos($id, $relativeDirectory="") {
   $customerPhotos = glob($relativeDirectory . "photos/customerPhotos/" . $id . "/*");
   $i = 0;
   $filteredCustomerPhotos = array();
   foreach($customerPhotos as $photo) {
    if($photo != "." && $photo != "photos/customerPhotos/" . $id . "/zipfile.zip") {
 		$filteredCustomerPhotos[$i] = $photo;
		$i++;
	}
   }
   return $filteredCustomerPhotos;
  }
  
  public function getCustomerDirectories() {
   $customerDirectories = glob("photos/customerPhotos/*", GLOB_ONLYDIR);
   return $customerDirectories;
  }
  
  public function login($username, $password) {
   $conn =$this->getConnection();
   $loginQuery = "Select id, adminPermission from users where username = :username and password = :password and isActive = 1";
   $q = $conn->prepare($loginQuery);
   $q->bindParam(":username", $username);
   $q->bindParam(":password", $password);
   $q->execute();
   $results = $q->fetchAll();
   reset($results);
   return $results;
 }

  public function getCustomers() {
   $conn =$this->getConnection();
   $query = "Select id, username, firstName, lastName from users where adminPermission = 0";
   $q = $conn->prepare($query);
   $q->execute();
   $results = $q->fetchAll();
   reset($results);
   return $results;
  }

  public function getCustomer($id) {
   $conn =$this->getConnection();
   $query = "Select id, username, firstName, lastName, isActive from users where id = :id";
   $q = $conn->prepare($query);
   $q->bindParam(":id", $id);
   $q->execute();
   $results = $q->fetchAll();
   reset($results);
   return $results[0];
  }
  
  public function getCustomerIdByUsername($username) {
   $conn =$this->getConnection();
   $query = "Select id, username, firstName, lastName, isActive from users where username = :username";
   $q = $conn->prepare($query);
   $q->bindParam(":username", $username);
   $q->execute();
   $results = $q->fetchAll();
   reset($results);
   return $results[0]["id"];
  }
  
  public function getCustomerByUsername($username) {
   $conn =$this->getConnection();
   $query = "Select id, username, firstName, lastName, isActive from users where username = :username";
   $q = $conn->prepare($query);
   $q->bindParam(":username", $username);
   $q->execute();
   $results = $q->fetchAll();
   return reset($results);
  }
  
  public function updatePassword($id, $password) {
   $conn =$this->getConnection();
   $query = "Update users set password = :password where id = :id";
   $q = $conn->prepare($query);
   $q->bindParam(":id", $id);
   $q->bindParam(":password", $password);
   $q->execute();
  }
  
  public function saveCustomerInfo($id, $username, $firstName, $lastName, $isActive) {
   $conn =$this->getConnection();
   $query = "Update users set username = :username, firstName = :firstName, lastName = :lastName, isActive = :isActive where id = :id";
   $q = $conn->prepare($query);
   $q->bindParam(":id", $id);
   $q->bindParam(":username", $username);
   $q->bindParam(":firstName", $firstName);
   $q->bindParam(":lastName", $lastName);
   $q->bindParam(":isActive", $isActive);
   $q->execute();
  }
  
  public function insertCustomer($username, $password, $firstName, $lastName, $isActive) {
   $conn =$this->getConnection();
   $query = "insert into users (username, password, firstname, lastname, adminPermission, isActive) values (:username, :password, :firstName, :lastName, 0, :isActive)";
   $q = $conn->prepare($query);
   $q->bindParam(":username", $username);
   $q->bindParam(":password", $password);
   $q->bindParam(":firstName", $firstName);
   $q->bindParam(":lastName", $lastName);
   $q->bindParam(":isActive", $isActive);
   $q->execute();
  }
  
  public function getConnection() {
   return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
  }

 }

