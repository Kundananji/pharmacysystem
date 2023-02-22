<?php
class FeeCategory implements \JsonSerializable{

/**
* member variables
*/
  private $feeCategoryId;
  private $name;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of feeCategoryId
* @param feeCategoryId : value to set
*/
  public function setFeeCategoryId($feeCategoryId){
    $this->feeCategoryId=$feeCategoryId;

  }

/**
* function to get the value of feeCategoryId
* @return int(10)
*/
  public function getFeeCategoryId(){
    return $this->feeCategoryId;

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
* function to get the string value of  FeeCategory
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  FeeCategory
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
