<?php
 session_start();
//include scripts
include("../config/database.php");
include("../config/authentication.php");
$authentication = new Authentication();
$queryString=isset($_SESSION['QUERI_STRING'])?$_SESSION['QUERI_STRING']:null;


if($_POST["email"]==null || $_POST["email"]==""){ 
  exit(json_encode(array("title"=>"email required","status"=>"error","message"=>"The field email is required")));
}
if($_POST["password"]==null || $_POST["password"]==""){ 
  exit(json_encode(array("title"=>"password required","status"=>"error","message"=>"The field password is required")));
}


$email =filter_var($_POST["email"],FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);

try{
  //initialize empty objects for the very rare condition where both the email and username field are not set
   // so that the code only returns a invalid credentails message
  $objects = array();


   $user = $authentication->getUserByEmail($email);
  
    //if search by email returns nothing, then try to search by username, if a username is set
    if($user == null){
      $user = $authentication->getUserByUsername($email);
    }
    
}
catch(Exception $ex){
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Invalid Credentials.","error"=>$ex)));
}


if($user!=null){ 
  
  $hashedPassword = $user["password"];

  if(password_verify($password,$hashedPassword)){

    //we can create a cookie if rememberMe is set
    //this cookie will store the user credentials for a period of 2 weeks, after which it will expire
    if(isset($_POST["rememberMe"]) && $_POST["rememberMe"] == true){

      //delete existing user tokens if any
      $authentication->deleteUserToken($user["id"]);

      //generate random tokens for authentication
      $authentication->rememberMe($user);

    }

    $authentication->logUserIn($user);

    //set up user profile
    $profileDetails = $authentication->getUserProfile($user);
    $_SESSION['user_profile'] = $profileDetails['name'];
    $_SESSION['user_profile_id'] = $profileDetails['id'];



    //put user variables in scope for use in start up
    foreach($user as $key=>$value){
       $$key = $value;
    }



    //start up sessions


    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Login success!","params"=>$queryString)));
  }
  else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Invalid Credentials.")));
  }


}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Invalid Credentials")));
}

 
 
 