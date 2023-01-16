<?php
class Invoices implements \JsonSerializable{

/**
* member variables
*/
  private $invoiceId;
  private $feeId;
  private $medicineId;
  private $item;
  private $description;
  private $unitPrice;
  private $quantity;
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
* function to set the value of item
* @param item : value to set
*/
  public function setItem($item){
    $this->item=$item;

  }

/**
* function to get the value of item
* @return String
*/
  public function getItem(){
    return $this->item;

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
* function to set the value of unitPrice
* @param unitPrice : value to set
*/
  public function setUnitPrice($unitPrice){
    $this->unitPrice=$unitPrice;

  }

/**
* function to get the value of unitPrice
* @return decimal(10,2)
*/
  public function getUnitPrice(){
    return $this->unitPrice;

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
* @return int(10)
*/
  public function getQuantity(){
    return $this->quantity;

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
    return $this->invoiceId.' | '.$this->feeId.' | '.$this->medicineId.' | '.$this->item;

  }

/**
* function to get the json equivalent of  Invoices
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
