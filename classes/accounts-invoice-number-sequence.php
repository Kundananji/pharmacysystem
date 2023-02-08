<?php
class AccountsInvoiceNumberSequence implements \JsonSerializable{

/**
* member variables
*/
  private $sequenceId;
  private $year;
  private $invoiceNumber;

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
* @return int(100)
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
* @return int(50)
*/
  public function getYear(){
    return $this->year;

  }

/**
* function to set the value of invoiceNumber
* @param invoiceNumber : value to set
*/
  public function setInvoiceNumber($invoiceNumber){
    $this->invoiceNumber=$invoiceNumber;

  }

/**
* function to get the value of invoiceNumber
* @return int(100)
*/
  public function getInvoiceNumber(){
    return $this->invoiceNumber;

  }

/**
* function to get the string value of  AccountsInvoiceNumberSequence
* @return string
*/
  public function toString(){
    return $this->sequenceId.' | '.$this->year.' | '.$this->invoiceNumber;

  }

/**
* function to get the json equivalent of  AccountsInvoiceNumberSequence
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
