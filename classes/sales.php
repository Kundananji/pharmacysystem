<?php
class Sales implements \JsonSerializable{

/**
* member variables
*/
  private $customerId;
  private $invoiceNumber;
  private $medicineName;
  private $batchId;
  private $expiryDate;
  private $quantity;
  private $mrp;
  private $discount;
  private $total;

/**
* function to initialize object
*/
  function __construct(){

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
* function to set the value of invoiceNumber
* @param invoiceNumber : value to set
*/
  public function setInvoiceNumber($invoiceNumber){
    $this->invoiceNumber=$invoiceNumber;

  }

/**
* function to get the value of invoiceNumber
* @return String
*/
  public function getInvoiceNumber(){
    return $this->invoiceNumber;

  }

/**
* function to set the value of medicineName
* @param medicineName : value to set
*/
  public function setMedicineName($medicineName){
    $this->medicineName=$medicineName;

  }

/**
* function to get the value of medicineName
* @return String
*/
  public function getMedicineName(){
    return $this->medicineName;

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
* function to set the value of mrp
* @param mrp : value to set
*/
  public function setMrp($mrp){
    $this->mrp=$mrp;

  }

/**
* function to get the value of mrp
* @return double
*/
  public function getMrp(){
    return $this->mrp;

  }

/**
* function to set the value of discount
* @param discount : value to set
*/
  public function setDiscount($discount){
    $this->discount=$discount;

  }

/**
* function to get the value of discount
* @return decimal(10,2)
*/
  public function getDiscount(){
    return $this->discount;

  }

/**
* function to set the value of total
* @param total : value to set
*/
  public function setTotal($total){
    $this->total=$total;

  }

/**
* function to get the value of total
* @return decimal(10,2)
*/
  public function getTotal(){
    return $this->total;

  }

/**
* function to get the string value of  Sales
* @return string
*/
  public function toString(){
    return $this->customerId.' | '.$this->invoiceNumber.' | '.$this->medicineName.' | '.$this->batchId;

  }

/**
* function to get the json equivalent of  Sales
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
