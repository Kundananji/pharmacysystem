<?php
class ReceiptDetail implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $receiptId;
  private $item;
  private $description;
  private $quantity;
  private $unitPrice;
  private $totalAmount;
  private $invoiceDetailId;
  private $feeId;
  private $medicineId;
  private $discount;

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
* @return int(50)
*/
  public function getId(){
    return $this->id;

  }

/**
* function to set the value of receiptId
* @param receiptId : value to set
*/
  public function setReceiptId($receiptId){
    $this->receiptId=$receiptId;

  }

/**
* function to get the value of receiptId
* @return int(50)
*/
  public function getReceiptId(){
    return $this->receiptId;

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
* @return int(11)
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
* @return int(11)
*/
  public function getDescription(){
    return $this->description;

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
* function to set the value of totalAmount
* @param totalAmount : value to set
*/
  public function setTotalAmount($totalAmount){
    $this->totalAmount=$totalAmount;

  }

/**
* function to get the value of totalAmount
* @return decimal(10,2)
*/
  public function getTotalAmount(){
    return $this->totalAmount;

  }

/**
* function to set the value of invoiceDetailId
* @param invoiceDetailId : value to set
*/
  public function setInvoiceDetailId($invoiceDetailId){
    $this->invoiceDetailId=$invoiceDetailId;

  }

/**
* function to get the value of invoiceDetailId
* @return int(50)
*/
  public function getInvoiceDetailId(){
    return $this->invoiceDetailId;

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
* @return int(50)
*/
  public function getMedicineId(){
    return $this->medicineId;

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
* function to get the string value of  ReceiptDetail
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->receiptId.' | '.$this->item.' | '.$this->description;

  }

/**
* function to get the json equivalent of  ReceiptDetail
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
