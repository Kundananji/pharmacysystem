<?php
class HospitalProcedure implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $description;
  private $departmentId;
  private $feeId;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of id
* @param id : value to set
*/
  public function setId($id){
    $this->id=$id;

  }

/**
* function to get the value of id
* @return int(11)
*/
  public function getId(){
    return $this->id;

  }

/**
* function to set the value of name
* @param name : value to set
*/
  public function setName($name){
    $this->name=$name;

  }

/**
* function to get the value of name
* @return String
*/
  public function getName(){
    return $this->name;

  }

/**
* function to set the value of description
* @param description : value to set
*/
  public function setDescription($description){
    $this->description=$description;

  }

/**
* function to get the value of description
* @return String
*/
  public function getDescription(){
    return $this->description;

  }

/**
* function to set the value of departmentId
* @param departmentId : value to set
*/
  public function setDepartmentId($departmentId){
    $this->departmentId=$departmentId;

  }

/**
* function to get the value of departmentId
* @return int(10)
*/
  public function getDepartmentId(){
    return $this->departmentId;

  }

/**
* function to set the value of feeId
* @param feeId : value to set
*/
  public function setFeeId($feeId){
    $this->feeId=$feeId;

  }

/**
* function to get the value of feeId
* @return int(10)
*/
  public function getFeeId(){
    return $this->feeId;

  }

/**
* function to get the string value of  HospitalProcedure
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  HospitalProcedure
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
