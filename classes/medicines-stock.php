<?php
class MedicinesStock implements \JsonSerializable{

/**
* member variables
*/
  private $iD;
  private $nAME;
  private $batchId;
  private $expiryDate;
  private $quantity;
  private $mRP;
  private $rATE;

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
* function to set the value of batchId
* @param batchId : value to set
*/
  public function setBatchId($batchId){
    $this->batchId=$batchId;

  }

/**
* function to get the value of batchId
* @return String
*/
  public function getBatchId(){
    return $this->batchId;

  }

/**
* function to set the value of expiryDate
* @param expiryDate : value to set
*/
  public function setExpiryDate($expiryDate){
    $this->expiryDate=$expiryDate;

  }

/**
* function to get the value of expiryDate
* @return String
*/
  public function getExpiryDate(){
    return $this->expiryDate;

  }

/**
* function to set the value of quantity
* @param quantity : value to set
*/
  public function setquantity($quantity){
    $this->quantity=$quantity;

  }

/**
* function to get the value of quantity
* @return int(11)
*/
  public function getquantity(){
    return $this->quantity;

  }

/**
* function to set the value of mRP
* @param mRP : value to set
*/
  public function setMRP($mRP){
    $this->mRP=$mRP;

  }

/**
* function to get the value of mRP
* @return double
*/
  public function getMRP(){
    return $this->mRP;

  }

/**
* function to set the value of rATE
* @param rATE : value to set
*/
  public function setRATE($rATE){
    $this->rATE=$rATE;

  }

/**
* function to get the value of rATE
* @return double
*/
  public function getRATE(){
    return $this->rATE;

  }

/**
* function to get the string value of  MedicinesStock
* @return string
*/
  public function toString(){
    return $this->iD.' | '.$this->nAME.' | '.$this->batchId.' | '.$this->expiryDate;

  }

/**
* function to get the json equivalent of  MedicinesStock
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
