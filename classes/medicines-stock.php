<?php
class MedicinesStock implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $medicineId;
  private $batchId;
  private $expiryDate;
  private $quantity;
  private $amount;

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
* function to set the value of medicineId
* @param medicineId : value to set
*/
  public function setMedicineId($medicineId){
    $this->medicineId=$medicineId;

  }

/**
* function to get the value of medicineId
* @return int(10)
*/
  public function getMedicineId(){
    return $this->medicineId;

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
* @return date
*/
  public function getExpiryDate(){
    return $this->expiryDate;

  }

/**
* function to set the value of quantity
* @param quantity : value to set
*/
  public function setQuantity($quantity){
    $this->quantity=$quantity;

  }

/**
* function to get the value of quantity
* @return int(11)
*/
  public function getQuantity(){
    return $this->quantity;

  }

/**
* function to set the value of amount
* @param amount : value to set
*/
  public function setAmount($amount){
    $this->amount=$amount;

  }

/**
* function to get the value of amount
* @return double
*/
  public function getAmount(){
    return $this->amount;

  }

/**
* function to get the string value of  MedicinesStock
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->medicineId.' | '.$this->batchId.' | '.$this->expiryDate;

  }

/**
* function to get the json equivalent of  MedicinesStock
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
