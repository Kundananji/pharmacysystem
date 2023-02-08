<?php
class AccountsReceiptNumberSequence implements \JsonSerializable{

/**
* member variables
*/
  private $sequenceId;
  private $year;
  private $receiptNumber;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of sequenceId
* @param sequenceId : value to set
*/
  public function setSequenceId($sequenceId){
    $this->sequenceId=$sequenceId;

  }

/**
* function to get the value of sequenceId
* @return int(11)
*/
  public function getSequenceId(){
    return $this->sequenceId;

  }

/**
* function to set the value of year
* @param year : value to set
*/
  public function setYear($year){
    $this->year=$year;

  }

/**
* function to get the value of year
* @return int(11)
*/
  public function getYear(){
    return $this->year;

  }

/**
* function to set the value of receiptNumber
* @param receiptNumber : value to set
*/
  public function setReceiptNumber($receiptNumber){
    $this->receiptNumber=$receiptNumber;

  }

/**
* function to get the value of receiptNumber
* @return int(11)
*/
  public function getReceiptNumber(){
    return $this->receiptNumber;

  }

/**
* function to get the string value of  AccountsReceiptNumberSequence
* @return string
*/
  public function toString(){
    return $this->sequenceId.' | '.$this->year.' | '.$this->receiptNumber;

  }

/**
* function to get the json equivalent of  AccountsReceiptNumberSequence
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
