<?php
class Invoice implements \JsonSerializable{

/**
* member variables
*/
  private $invoiceId;
  private $invoiceNo;
  private $description;
  private $invoiceDate;
  private $patientId;
  private $taxAmount;
  private $amount;
  private $isPaidFor;

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
* @return int(50)
*/
  public function getInvoiceId(){
    return $this->invoiceId;

  }

/**
* function to set the value of invoiceNo
* @param invoiceNo : value to set
*/
  public function setInvoiceNo($invoiceNo){
    $this->invoiceNo=$invoiceNo;

  }

/**
* function to get the value of invoiceNo
* @return String
*/
  public function getInvoiceNo(){
    return $this->invoiceNo;

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
* function to set the value of patientId
* @param patientId : value to set
*/
  public function setPatientId($patientId){
    $this->patientId=$patientId;

  }

/**
* function to get the value of patientId
* @return int(50)
*/
  public function getPatientId(){
    return $this->patientId;

  }

/**
* function to set the value of taxAmount
* @param taxAmount : value to set
*/
  public function setTaxAmount($taxAmount){
    $this->taxAmount=$taxAmount;

  }

/**
* function to get the value of taxAmount
* @return decimal(10,2)
*/
  public function getTaxAmount(){
    return $this->taxAmount;

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
* function to set the value of isPaidFor
* @param isPaidFor : value to set
*/
  public function setIsPaidFor($isPaidFor){
    $this->isPaidFor=$isPaidFor;

  }

/**
* function to get the value of isPaidFor
* @return int(10)
*/
  public function getIsPaidFor(){
    return $this->isPaidFor;

  }

/**
* function to get the string value of  Invoice
* @return string
*/
  public function toString(){
    return $this->description;

  }

/**
* function to get the json equivalent of  Invoice
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
