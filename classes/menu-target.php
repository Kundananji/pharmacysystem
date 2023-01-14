<?php
class MenuTarget implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;

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
* function to get the string value of  MenuTarget
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  MenuTarget
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
