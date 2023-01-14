<?php
class Invoices implements \JsonSerializable{

/**
* member variables
*/
  private $invoiceId;
  private $netTotal;
  private $invoiceDate;
  private $customerId;
  private $totalAmount;
  private $totalDiscount;

/**
* function to initialize object
*/
  function __construct(){

  }

/**
* function to set the value of invoiceId
* @param invoiceId : value to set
*/
  public function setInvoiceId($invoiceId){
    $this->invoiceId=$invoiceId;

  }

/**
* function to get the value of invoiceId
* @return int(11)
*/
  public function getInvoiceId(){
    return $this->invoiceId;

  }

/**
* function to set the value of netTotal
* @param netTotal : value to set
*/
  public function setNetTotal($netTotal){
    $this->netTotal=$netTotal;

  }

/**
* function to get the value of netTotal
* @return double
*/
  public function getNetTotal(){
    return $this->netTotal;

  }

/**
* function to set the value of invoiceDate
* @param invoiceDate : value to set
*/
  public function setInvoiceDate($invoiceDate){
    $this->invoiceDate=$invoiceDate;

  }

/**
* function to get the value of invoiceDate
* @return date
*/
  public function getInvoiceDate(){
    return $this->invoiceDate;

  }

/**
* function to set the value of customerId
* @param customerId : value to set
*/
  public function setCustomerId($customerId){
    $this->customerId=$customerId;

  }

/**
* function to get the value of customerId
* @return int(11)
*/
  public function getCustomerId(){
    return $this->customerId;

  }

/**
* function to set the value of totalAmount
* @param totalAmount : value to set
*/
  public function setTotalAmount($totalAmount){
    $this->totalAmount=$totalAmount;

  }

/**
* function to get the value of totalAmount
* @return double
*/
  public function getTotalAmount(){
    return $this->totalAmount;

  }

/**
* function to set the value of totalDiscount
* @param totalDiscount : value to set
*/
  public function setTotalDiscount($totalDiscount){
    $this->totalDiscount=$totalDiscount;

  }

/**
* function to get the value of totalDiscount
* @return double
*/
  public function getTotalDiscount(){
    return $this->totalDiscount;

  }

/**
* function to get the string value of  Invoices
* @return string
*/
  public function toString(){
    return $this->invoiceId.' | '.$this->netTotal.' | '.$this->invoiceDate.' | '.$this->customerId;

  }

/**
* function to get the json equivalent of  Invoices
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
