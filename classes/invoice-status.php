<?php
class InvoiceStatus implements \JsonSerializable{

/**
* member variables
*/
  private $invoiceStatusId;
  private $name;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of invoiceStatusId
* @param invoiceStatusId : value to set
*/
  public function setInvoiceStatusId($invoiceStatusId){
    $this->invoiceStatusId=$invoiceStatusId;

  }

/**
* function to get the value of invoiceStatusId
* @return int(10)
*/
  public function getInvoiceStatusId(){
    return $this->invoiceStatusId;

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
* function to get the string value of  InvoiceStatus
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  InvoiceStatus
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
