<?php
  session_start();

 include("../config/database.php");
 include("../config/authentication.php");
 
 $authentication = new Authentication();

 $userLoggedIn = $authentication->isUserLoggedIn();
 if($userLoggedIn){
  $authentication->logout();
 }

exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"User Successfully logged out!")));

 