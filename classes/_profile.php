<?php
class Profile implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $description;
  private $isActive;
  private $isDefault;

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
* function to set the value of isActive
* @param isActive : value to set
*/
  public function setIsActive($isActive){
    $this->isActive=$isActive;

  }

/**
* function to get the value of isActive
* @return int(11)
*/
  public function getIsActive(){
    return $this->isActive;

  }

/**
* function to set the value of isDefault
* @param isDefault : value to set
*/
  public function setIsDefault($isDefault){
    $this->isDefault=$isDefault;

  }

/**
* function to get the value of isDefault
* @return int(11)
*/
  public function getIsDefault(){
    return $this->isDefault;

  }

/**
* function to get the string value of  Profile
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  Profile
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
