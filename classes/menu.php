<?php
class Menu implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $icon;
  private $name;
  private $label;
  private $url;
  private $target;
  private $parentId;
  private $profileId;
  private $idName;

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
* function to set the value of icon
* @param icon : value to set
*/
  public function setIcon($icon){
    $this->icon=$icon;

  }

/**
* function to get the value of icon
* @return String
*/
  public function getIcon(){
    return $this->icon;

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
* function to set the value of label
* @param label : value to set
*/
  public function setLabel($label){
    $this->label=$label;

  }

/**
* function to get the value of label
* @return String
*/
  public function getLabel(){
    return $this->label;

  }

/**
* function to set the value of url
* @param url : value to set
*/
  public function setUrl($url){
    $this->url=$url;

  }

/**
* function to get the value of url
* @return String
*/
  public function getUrl(){
    return $this->url;

  }

/**
* function to set the value of target
* @param target : value to set
*/
  public function setTarget($target){
    $this->target=$target;

  }

/**
* function to get the value of target
* @return int(10)
*/
  public function getTarget(){
    return $this->target;

  }

/**
* function to set the value of parentId
* @param parentId : value to set
*/
  public function setParentId($parentId){
    $this->parentId=$parentId;

  }

/**
* function to get the value of parentId
* @return int(10)
*/
  public function getParentId(){
    return $this->parentId;

  }

/**
* function to set the value of profileId
* @param profileId : value to set
*/
  public function setProfileId($profileId){
    $this->profileId=$profileId;

  }

/**
* function to get the value of profileId
* @return int(10)
*/
  public function getProfileId(){
    return $this->profileId;

  }

/**
* function to set the value of idName
* @param idName : value to set
*/
  public function setIdName($idName){
    $this->idName=$idName;

  }

/**
* function to get the value of idName
* @return String
*/
  public function getIdName(){
    return $this->idName;

  }

/**
* function to get the string value of  Menu
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  Menu
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
