<?php
class Medicines implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $packing;
  private $genericName;
  private $supplierId;

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
* function to set the value of packing
* @param packing : value to set
*/
  public function setPacking($packing){
    $this->packing=$packing;

  }

/**
* function to get the value of packing
* @return String
*/
  public function getPacking(){
    return $this->packing;

  }

/**
* function to set the value of genericName
* @param genericName : value to set
*/
  public function setGenericName($genericName){
    $this->genericName=$genericName;

  }

/**
* function to get the value of genericName
* @return String
*/
  public function getGenericName(){
    return $this->genericName;

  }

/**
* function to set the value of supplierId
* @param supplierId : value to set
*/
  public function setSupplierId($supplierId){
    $this->supplierId=$supplierId;

  }

/**
* function to get the value of supplierId
* @return int(10)
*/
  public function getSupplierId(){
    return $this->supplierId;

  }

/**
* function to get the string value of  Medicines
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  Medicines
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
