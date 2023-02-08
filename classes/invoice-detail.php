<?php
class InvoiceDetail implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $invoiceId;
  private $feeId;
  private $medicineId;
  private $description;
  private $unitPrice;
  private $quantity;
  private $discount;
  private $totalAmount;

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
* function to get the string value of  InvoiceDetail
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->invoiceId.' | '.$this->feeId.' | '.$this->medicineId;

  }

/**
* function to get the json equivalent of  InvoiceDetail
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
