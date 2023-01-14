<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/menu-target-dao.php");

$menuTargetDao = new MenuTargetDao();

if(isset($_POST["menuTargetId"]) && (int)$_POST["menuTargetId"] > 0){
  $menuTargetId = $_POST["menuTargetId"];
  if($menuTargetDao->delete($menuTargetId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


