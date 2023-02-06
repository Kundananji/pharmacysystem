<?php
class Customers implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $contactNumber;
  private $address;
  private $doctorId;

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
* function to set the value of contactNumber
* @param contactNumber : value to set
*/
  public function setContactNumber($contactNumber){
    $this->contactNumber=$contactNumber;

  }

/**
* function to get the value of contactNumber
* @return String
*/
  public function getContactNumber(){
    return $this->contactNumber;

  }

/**
* function to set the value of address
* @param address : value to set
*/
  public function setAddress($address){
    $this->address=$address;

  }

/**
* function to get the value of address
* @return String
*/
  public function getAddress(){
    return $this->address;

  }

/**
* function to set the value of doctorId
* @param doctorId : value to set
*/
  public function setDoctorId($doctorId){
    $this->doctorId=$doctorId;

  }

/**
* function to get the value of doctorId
* @return int(10)
*/
  public function getDoctorId(){
    return $this->doctorId;

  }

/**
* function to get the string value of  Customers
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  Customers
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
