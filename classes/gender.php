<?php
class Gender implements \JsonSerializable{

/**
* member variables
*/
  private $genderId;
  private $name;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of genderId
* @param genderId : value to set
*/
  public function setGenderId($genderId){
    $this->genderId=$genderId;

  }

/**
* function to get the value of genderId
* @return int(11)
*/
  public function getGenderId(){
    return $this->genderId;

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
* function to get the string value of  Gender
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  Gender
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
