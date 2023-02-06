<?php
class Fee implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $description;
  private $amount;
  private $status;

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
* @return int(10)
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
* @return text
*/
  public function getDescription(){
    return $this->description;

  }

/**
* function to set the value of amount
* @param amount : value to set
*/
  public function setAmount($amount){
    $this->amount=$amount;

  }

/**
* function to get the value of amount
* @return decimal(10,2)
*/
  public function getAmount(){
    return $this->amount;

  }

/**
* function to set the value of status
* @param status : value to set
*/
  public function setStatus($status){
    $this->status=$status;

  }

/**
* function to get the value of status
* @return int(10)
*/
  public function getStatus(){
    return $this->status;

  }

/**
* function to get the string value of  Fee
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  Fee
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
