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
  private $db = "heroku_4254fa8ab32f37d?";
  private $user = "bd1074010cdff0";
  private $password = "3bdb2b75";

   public function getGalleryPhotos() {
   $galleryPhotos = glob("photos/*.jpg");
   return $galleryPhotos;
  }

  public function getCustomerPhotos($id) {
   $director = "photos/" . $id . "/";
   $customerPhotos = glob("photos/customerPhotos/" . $id . "/*.jpg");
   return $customerPhotos;
  }
  
  public function getCustomerDirectories() {
   $customerDirectories = glob("photos/customerPhotos/*", GLOB_ONLYDIR);
   return $customerDirectories;
  }
  
  public function login($username, $password) {
   $conn =$this->getConnection();
   $loginQuery = "Select id, adminPermission from users where username = :username and password = :password";
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
 
  public function getConnection() {
   return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
  }

 }

