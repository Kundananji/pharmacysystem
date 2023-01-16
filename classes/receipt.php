<?php
class Receipt implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $description;
  private $patientId;
  private $receiptNo;
  private $receiptDate;
  private $amount;
  private $paymentMethodId;

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
* function to set the value of description
* @param description : value to set
*/
  public function setDescription($description){
    $this->description=$description;

  }

/**
* function to get the value of description
* @return String
*/
  public function getDescription(){
    return $this->description;

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
* function to set the value of receiptNo
* @param receiptNo : value to set
*/
  public function setReceiptNo($receiptNo){
    $this->receiptNo=$receiptNo;

  }

/**
* function to get the value of receiptNo
* @return String
*/
  public function getReceiptNo(){
    return $this->receiptNo;

  }

/**
* function to set the value of receiptDate
* @param receiptDate : value to set
*/
  public function setReceiptDate($receiptDate){
    $this->receiptDate=$receiptDate;

  }

/**
* function to get the value of receiptDate
* @return date
*/
  public function getReceiptDate(){
    return $this->receiptDate;

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
* function to set the value of paymentMethodId
* @param paymentMethodId : value to set
*/
  public function setPaymentMethodId($paymentMethodId){
    $this->paymentMethodId=$paymentMethodId;

  }

/**
* function to get the value of paymentMethodId
* @return int(10)
*/
  public function getPaymentMethodId(){
    return $this->paymentMethodId;

  }

/**
* function to get the string value of  Receipt
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->description.' | '.$this->patientId.' | '.$this->receiptNo;

  }

/**
* function to get the json equivalent of  Receipt
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
