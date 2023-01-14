<?php
//include scripts
include("../config/database.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");

$usersDao = new UsersDao();
$usersEdit = new Users();


 if($_POST["email"]==null || $_POST["email"]==''){ 
  exit(json_encode(array("title"=>"email required","status"=>"error","message"=>"The field email is required")));
}


$email =filter_var($_POST["email"],FILTER_SANITIZE_STRING);

$users = $usersDao->selectBy(array('email'),array($email),array("s"));


if($users !=null && sizeof($users) >0){

  $user = $users[0];
  
  $hashedPassword = $user->getPassword();
   

  $siteUrl = $_SERVER['HTTP_HOST'];
  $senderEmail ="hms@kundananjicreations.com";
  $subject="Password Reset Request for $siteUrl";

  $body="Hi ".$user->getName()."!<br/><br/>";
  $body.="You are getting this email because there was a request to reset your password on your account for HMS.<br/><br/>";
  $body.="To reset your password, click the link below:<br/><br/>";
  $body.="<a href=\"https://$siteUrl/reset-account-password.php?reset_id=$hashedPassword&email_id=$email\">Click here to reset your password</a><br/><br/>";
  $body.="If you did not make this request, you may want to take necessary actions to secure your account such as logging into your account and updating your password.<br/><br/>";
  $body.="Kind regards,<br/><br/>";
  $body.="The HMS Team.";

  $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $headers .= 'From: HMS <'.$senderEmail.'>' . "\r\n";
  if($_SERVER['HTTP_HOST'] !="localhost"){
    //echo $body;
    mail($email,$subject,$body,$headers);
  }

}
 exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Request sent successfully")));
 
