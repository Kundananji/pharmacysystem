<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/medicines-dao.php");

$medicinesDao = new MedicinesDao();

if(isset($_POST["medicinesId"]) && (int)$_POST["medicinesId"] > 0){
  $medicinesId = $_POST["medicinesId"];
  if($medicinesDao->delete($medicinesId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


