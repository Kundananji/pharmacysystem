<?php
class Department implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $description;

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
* function to get the string value of  Department
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  Department
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
