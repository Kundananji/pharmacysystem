<?php
$fileName = $_FILES['file']['name'];
//get file extension
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowedExtensions =['jpg','png','jpeg','mp4','gif','pdf'];
if(!in_array($ext,$allowedExtensions)){
  exit(json_encode(array("status"=>"failure","message"=>"Sorry, the type of file you uploaded is not allowed","title"=>"Wrong File")));
}


$typeOfFile =$_POST['typeOfFile'];
$fieldName =$_POST['fieldName'];
$path = '';
if($typeOfFile=='photo'){
  $path='../uploads/photos/';
}else
if($typeOfFile=='video'){
  $path='../uploads/videos/';
}else
if($typeOfFile=='file'){
  $path='../uploads/files/';
}else{
  $path='../uploads/files/';
}
if(!file_exists($path)){
  mkdir($path,0777,true);
}
//create new file name
$newFileName = time().'_'.$fieldName.'.'.$ext;
$location = $path.$newFileName;
if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
  exit(json_encode(array("status"=>"success","message"=>"Upload success","title"=>"Uploaded Successfully","url"=>str_ireplace("../","",$location))));
}else{
  exit(json_encode(array("status"=>"failure","message"=>"Upload Failure. Try again later.","title"=>"Upload Failure","url"=>str_ireplace("../","",$location))));
}


