<?php
session_start();
//include scripts
include("../config/database.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");
include_once("../util/convert-date.php");

$userId = $_SESSION["user_id"];

$usersDao = new UsersDao();
$users =  $usersDao->select($userId);
if($users == null){
  exit(json_encode(array("title"=>"Session expired","status"=>"error","message"=>"Your session has expired. Please login to continue...")));
}


if(!isset($_POST["username"]) || $_POST["username"]==''){ 
  exit(json_encode(array("title"=>"username required","status"=>"error","message"=>"The field username is required")));
}
if(!isset($_POST["firstName"]) || $_POST["firstName"]==''){ 
  exit(json_encode(array("title"=>"firstName required","status"=>"error","message"=>"The field firstName is required")));
}
if(!isset($_POST["lastName"]) || $_POST["lastName"]==''){ 
  exit(json_encode(array("title"=>"lastName required","status"=>"error","message"=>"The field lastName is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

 
$hashedPassword = null; 
if(isset($_POST["password"]) && $_POST["password"]!=null && isset($_POST["newPassword"]) && $_POST["newPassword"]!=''){ 
  if(!isset($_POST["newPassword"]) || $_POST["newPassword"]==""){  
     exit(json_encode(array("title"=>"Password missing","status"=>"error","message"=>"Please enter the new password"))); 
  }
  if($_POST["newPassword"] != $_POST["confirmPassword"]){  
    exit(json_encode(array("title"=>"Passwords do not match","status"=>"error","message"=>"The new passwords do not match."))); 
  }; 

//this is the enered password, compare it with stored password
$password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
$newPassword = filter_var($_POST["newPassword"],FILTER_SANITIZE_STRING);
//hash password according to specified algorigthm
$hashedPassword = password_hash($newPassword,PASSWORD_DEFAULT); 
if(!password_verify($password,$user->getPassword())){
  exit(json_encode(array("title"=>"Wrong current password","status"=>"error","message"=>"You entered the wrong current password. Please enter the correct password")));  
 }  
 } //end password check 
$users->setUsername(!isset($_POST["username"]) || $_POST["username"]==""?NULL:filter_var($_POST["username"],FILTER_SANITIZE_STRING));
$users->setFirstName(!isset($_POST["firstName"]) || $_POST["firstName"]==""?NULL:filter_var($_POST["firstName"],FILTER_SANITIZE_STRING));
$users->setLastName(!isset($_POST["lastName"]) || $_POST["lastName"]==""?NULL:filter_var($_POST["lastName"],FILTER_SANITIZE_STRING));
if(isset($_POST['password'])&& $_POST["password"]!=null){
  $users->setPassword($hashedPassword);
}
$users->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$users->setEmail(!isset($_POST["email"]) || $_POST["email"]==""?NULL:filter_var($_POST["email"],FILTER_SANITIZE_STRING));
$users->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$users->setIsLoggedIn(!isset($_POST["isLoggedIn"]) || $_POST["isLoggedIn"]==""?NULL:filter_var($_POST["isLoggedIn"],FILTER_SANITIZE_NUMBER_INT));
$users->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));
$users->setProfile('Admin');


 try{$tempObject = $usersDao->update($users);
if($tempObject !=null){
  exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Your account details have been successfully saved!")));
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. your account could not be updated. Try again later.")));
}

 }
 catch(Exception $ex) {
   //process error message for common error messages and return
   //check for duplicate emails:
    $input = $ex->getMessage();
    //process string Duplicate entry 'gsimuusa@yahoo.com' for key 'email'
    $pattern = '/Duplicate entry \'(.*?)\' for key \'(.*?)\'/';
    preg_match_all($pattern, $input, $matches); 
    if(sizeof($matches)> 0 && isset($matches[2][0])){
      $pos = 0;

       //the nature of this regex implies that the returned matches will always be an array of size 3 with the following values:
      //0 - the whole matched string
      //1 - the first matched word - field value
      //2 - the second matched word - name of field
       exit(json_encode(array("title"=>$matches[2][0]." in use","status"=>"error","message"=>"Sorry, The ".$matches[2][0]." ". $matches[1][0]." is already in use!")));
      
    }
    else
        {
             exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Sorry, an error occurred. Try again later.")));

        }

 }
 
 