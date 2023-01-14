<?php
class Purchases implements \JsonSerializable{

/**
* member variables
*/
  private $supplierName;
  private $invoiceNumber;
  private $voucherNumber;
  private $purchaseDate;
  private $totalAmount;
  private $paymentStatus;

/**
* function to initialize object
*/
  function __construct(){

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
* function to set the value of invoiceNumber
* @param invoiceNumber : value to set
*/
  public function setInvoiceNumber($invoiceNumber){
    $this->invoiceNumber=$invoiceNumber;

  }

/**
* function to get the value of invoiceNumber
* @return int(11)
*/
  public function getInvoiceNumber(){
    return $this->invoiceNumber;

  }

/**
* function to set the value of voucherNumber
* @param voucherNumber : value to set
*/
  public function setVoucherNumber($voucherNumber){
    $this->voucherNumber=$voucherNumber;

  }

/**
* function to get the value of voucherNumber
* @return int(11)
*/
  public function getVoucherNumber(){
    return $this->voucherNumber;

  }

/**
* function to set the value of purchaseDate
* @param purchaseDate : value to set
*/
  public function setPurchaseDate($purchaseDate){
    $this->purchaseDate=$purchaseDate;

  }

/**
* function to get the value of purchaseDate
* @return String
*/
  public function getPurchaseDate(){
    return $this->purchaseDate;

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
* function to set the value of paymentStatus
* @param paymentStatus : value to set
*/
  public function setPaymentStatus($paymentStatus){
    $this->paymentStatus=$paymentStatus;

  }

/**
* function to get the value of paymentStatus
* @return String
*/
  public function getPaymentStatus(){
    return $this->paymentStatus;

  }

/**
* function to get the string value of  Purchases
* @return string
*/
  public function toString(){
    return $this->supplierName.' | '.$this->invoiceNumber.' | '.$this->voucherNumber.' | '.$this->purchaseDate;

  }

/**
* function to get the json equivalent of  Purchases
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
