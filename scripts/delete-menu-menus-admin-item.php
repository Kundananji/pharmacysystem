<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/menu-dao.php");

$menuDao = new MenuDao();

if(isset($_POST["menuId"]) && (int)$_POST["menuId"] > 0){
  $menuId = $_POST["menuId"];
  if($menuDao->delete($menuId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


