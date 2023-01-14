<?php
$file = $_POST['file'];
$file = str_ireplace("uploads/","../uploads/",$file) ;
if(unlink($file)){
  exit(json_encode(array("status"=>"success","message"=>"Delete success. File has been deleted successfully","title"=>"Deleted Successfully")));
}else{
  exit(json_encode(array("status"=>"failure","message"=>"Upload Failure. Try again later.","title"=>"Upload Failure")));
}


