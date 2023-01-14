<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/suppliers-dao.php");

$suppliersDao = new SuppliersDao();

if(isset($_POST["suppliersId"]) && (int)$_POST["suppliersId"] > 0){
  $suppliersId = $_POST["suppliersId"];
  if($suppliersDao->delete($suppliersId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


