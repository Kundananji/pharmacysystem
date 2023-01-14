<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");
include("../daos/_alternative-profile-dao.php");
include("../classes/_alternative-profile.php");
include("../daos/_profile-dao.php");
include("../classes/_profile.php");

 $profileDao = new Profiledao();
 //get default profile
 $defaultProfiles = $profileDao->selectBy(array("isDefault"),array(1),array("i")); 
 $defaultProfile = sizeof($defaultProfiles)>0? $defaultProfiles[0]:null;
 $profile = $defaultProfile !=null? $defaultProfile->getId() :17; 
$usersEditDao = new UsersDao();
$usersEdit = new Users();

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


      if($_POST["password"] != $_POST["confirmPassword"]){ 
       exit(json_encode(array("title"=>"Passwords do not match","status"=>"error","message"=>"The field profile is required")));
      }
       $usersEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setUsername(!isset($_POST["username"]) || $_POST["username"]==""?NULL:filter_var($_POST["username"],FILTER_SANITIZE_STRING));
$usersEdit->setFirstName(!isset($_POST["firstName"]) || $_POST["firstName"]==""?NULL:filter_var($_POST["firstName"],FILTER_SANITIZE_STRING));
$usersEdit->setLastName(!isset($_POST["lastName"]) || $_POST["lastName"]==""?NULL:filter_var($_POST["lastName"],FILTER_SANITIZE_STRING));

     $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
     $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    $usersEdit->setPassword($hashedPassword);
$usersEdit->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$usersEdit->setEmail(!isset($_POST["email"]) || $_POST["email"]==""?NULL:filter_var($_POST["email"],FILTER_SANITIZE_STRING));
$usersEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$usersEdit->setIsLoggedIn(!isset($_POST["isLoggedIn"]) || $_POST["isLoggedIn"]==""?NULL:filter_var($_POST["isLoggedIn"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setProfile($profile);


 try{$tempObject = $usersEditDao->insert($usersEdit);
if($tempObject !=null){
  exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Your account has been successfully created!")));
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. your account could not be created. Try again later.")));
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
 
 