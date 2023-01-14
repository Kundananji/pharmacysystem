<?php
    session_start();
    include("../config/database.php");
    include("../config/authentication.php");

    $authentication = new Authentication();

    $userLoggedIn = $authentication->isUserLoggedIn();
    if(!$userLoggedIn){
      exit(json_encode(array("title"=>"No Session","status"=>"failure","message"=>"User has no current session")));
    }
   
    if(!isset($_POST['session_field'])){
      exit(json_encode(array("title"=>"Switch Failed","status"=>"failure","message"=>"The required field is not set")));
    }

    if(!isset($_POST['setter_input'])){
      exit(json_encode(array("title"=>"Switch Failed","status"=>"failure","message"=>"The required field is not set")));
    }

    if(trim($_POST['setter_input'])==""){
      exit(json_encode(array("title"=>"Switch Failed","status"=>"failure","message"=>"The required field is not set")));
    }
       
    if(trim($_POST['session_field'])==""){
      exit(json_encode(array("title"=>"Switch Failed","status"=>"failure","message"=>"The required field is not set")));
    }

    $sessionField = filter_var($_POST["session_field"],FILTER_SANITIZE_STRING);
    $sessionInput = filter_var($_POST["setter_input"],FILTER_SANITIZE_STRING);  

    if($sessionField =="user_profile" ||$sessionField =="user_profile_id" || $sessionField =="user_id"){
      exit(json_encode(array("title"=>"Switch Failed","status"=>"failure","message"=>"The operation is not allowed")));
    }
 
    $_SESSION[$sessionField] = $sessionInput;       
  
    exit(json_encode(array("title"=>"Switch Successful","status"=>"success","message"=>"Successfully switched")));
    
  
    