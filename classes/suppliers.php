<?php
class Suppliers implements \JsonSerializable{

/**
* member variables
*/
  private $iD;
  private $name;
  private $email;
  private $contactNumber;
  private $address;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of iD
* @param iD : value to set
*/
  public function setID($iD){
    $this->iD=$iD;

  }

/**
* function to get the value of iD
* @return int(11)
*/
  public function getID(){
    return $this->iD;

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
* function to set the value of email
* @param email : value to set
*/
  public function setEmail($email){
    $this->email=$email;

  }

/**
* function to get the value of email
* @return String
*/
  public function getEmail(){
    return $this->email;

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
* function to get the string value of  Suppliers
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  Suppliers
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
