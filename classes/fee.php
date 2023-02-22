<?php
class Fee implements \JsonSerializable{

/**
* member variables
*/
  private $feeId;
  private $name;
  private $description;
  private $feeCategoryId;
  private $amount;
  private $status;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of feeId
* @param feeId : value to set
*/
  public function setFeeId($feeId){
    $this->feeId=$feeId;

  }

/**
* function to get the value of feeId
* @return int(10)
*/
  public function getFeeId(){
    return $this->feeId;

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
* function to set the value of amount
* @param amount : value to set
*/
  public function setAmount($amount){
    $this->amount=$amount;

  }

/**
* function to get the value of amount
* @return decimal(10,2)
*/
  public function getAmount(){
    return $this->amount;

  }

/**
* function to set the value of status
* @param status : value to set
*/
  public function setStatus($status){
    $this->status=$status;

  }

/**
* function to get the value of status
* @return int(10)
*/
  public function getStatus(){
    return $this->status;

  }

/**
* function to get the string value of  Fee
* @return string
*/
  public function toString(){
    return $this->name.'&nbsp;-&nbsp;'.$this->amount;

  }

/**
* function to get the json equivalent of  Fee
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
