<?php
 session_start();

 include("../config/database.php");
 include("../config/authentication.php");
 
 $authentication = new Authentication();

 $userLoggedIn = $authentication->isUserLoggedIn();
 if($userLoggedIn){
  exit(json_encode(array("title"=>"You are Logged in","status"=>"USER_LOGGED_IN","message"=>"User is currently logged in!")));
 }
 else{
  exit(json_encode(array("title"=>"Your Session has expired","status"=>"USER_LOGGED_OUT","message"=>"User is currently logged out!")));
 }
 