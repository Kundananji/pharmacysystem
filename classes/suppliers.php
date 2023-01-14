<?php
class Suppliers implements \JsonSerializable{

/**
* member variables
*/
  private $iD;
  private $nAME;
  private $eMAIL;
  private $contactNumber;
  private $aDDRESS;

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
* function to set the value of eMAIL
* @param eMAIL : value to set
*/
  public function setEMAIL($eMAIL){
    $this->eMAIL=$eMAIL;

  }

/**
* function to get the value of eMAIL
* @return String
*/
  public function getEMAIL(){
    return $this->eMAIL;

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
* function to set the value of aDDRESS
* @param aDDRESS : value to set
*/
  public function setADDRESS($aDDRESS){
    $this->aDDRESS=$aDDRESS;

  }

/**
* function to get the value of aDDRESS
* @return String
*/
  public function getADDRESS(){
    return $this->aDDRESS;

  }

/**
* function to get the string value of  Suppliers
* @return string
*/
  public function toString(){
    return $this->iD.' | '.$this->nAME.' | '.$this->eMAIL.' | '.$this->contactNumber;

  }

/**
* function to get the json equivalent of  Suppliers
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
