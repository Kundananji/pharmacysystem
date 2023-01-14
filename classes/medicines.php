<?php
class Medicines implements \JsonSerializable{

/**
* member variables
*/
  private $iD;
  private $nAME;
  private $pACKING;
  private $genericName;
  private $supplierName;

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
* function to set the value of nAME
* @param nAME : value to set
*/
  public function setNAME($nAME){
    $this->nAME=$nAME;

  }

/**
* function to get the value of nAME
* @return String
*/
  public function getNAME(){
    return $this->nAME;

  }

/**
* function to set the value of pACKING
* @param pACKING : value to set
*/
  public function setPACKING($pACKING){
    $this->pACKING=$pACKING;

  }

/**
* function to get the value of pACKING
* @return String
*/
  public function getPACKING(){
    return $this->pACKING;

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
* function to set the value of supplierName
* @param supplierName : value to set
*/
  public function setSupplierName($supplierName){
    $this->supplierName=$supplierName;

  }

/**
* function to get the value of supplierName
* @return String
*/
  public function getSupplierName(){
    return $this->supplierName;

  }

/**
* function to get the string value of  Medicines
* @return string
*/
  public function toString(){
    return $this->iD.' | '.$this->nAME.' | '.$this->pACKING.' | '.$this->genericName;

  }

/**
* function to get the json equivalent of  Medicines
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
