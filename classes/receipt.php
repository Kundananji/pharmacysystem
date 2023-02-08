<?php
class Receipt implements \JsonSerializable{

/**
* member variables
*/
  private $receiptId;
  private $description;
  private $patientId;
  private $receiptNo;
  private $invoiceId;
  private $receiptDate;
  private $invoiceAmount;
  private $amountPaid;
  private $paymentMethodId;
  private $changeAmount;

/**
* function to initialize object
*/
  function __construct(){

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
* function to set the value of invoiceAmount
* @param invoiceAmount : value to set
*/
  public function setInvoiceAmount($invoiceAmount){
    $this->invoiceAmount=$invoiceAmount;

  }

/**
* function to get the value of invoiceAmount
* @return decimal(10,2)
*/
  public function getInvoiceAmount(){
    return $this->invoiceAmount;

  }

/**
* function to set the value of amountPaid
* @param amountPaid : value to set
*/
  public function setAmountPaid($amountPaid){
    $this->amountPaid=$amountPaid;

  }

/**
* function to get the value of amountPaid
* @return decimal(10,2)
*/
  public function getAmountPaid(){
    return $this->amountPaid;

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
* function to set the value of changeAmount
* @param changeAmount : value to set
*/
  public function setChangeAmount($changeAmount){
    $this->changeAmount=$changeAmount;

  }

/**
* function to get the value of changeAmount
* @return decimal(10,2)
*/
  public function getChangeAmount(){
    return $this->changeAmount;

  }

/**
* function to get the string value of  Receipt
* @return string
*/
  public function toString(){
    return $this->receiptId.' | '.$this->description.' | '.$this->patientId.' | '.$this->receiptNo;

  }

/**
* function to get the json equivalent of  Receipt
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
