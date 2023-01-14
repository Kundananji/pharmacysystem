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
  private $qUANTITY;
  private $mRP;
  private $dISCOUNT;
  private $tOTAL;

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
* function to set the value of qUANTITY
* @param qUANTITY : value to set
*/
  public function setQUANTITY($qUANTITY){
    $this->qUANTITY=$qUANTITY;

  }

/**
* function to get the value of qUANTITY
* @return int(11)
*/
  public function getQUANTITY(){
    return $this->qUANTITY;

  }

/**
* function to set the value of mRP
* @param mRP : value to set
*/
  public function setMRP($mRP){
    $this->mRP=$mRP;

  }

/**
* function to get the value of mRP
* @return double
*/
  public function getMRP(){
    return $this->mRP;

  }

/**
* function to set the value of dISCOUNT
* @param dISCOUNT : value to set
*/
  public function setDISCOUNT($dISCOUNT){
    $this->dISCOUNT=$dISCOUNT;

  }

/**
* function to get the value of dISCOUNT
* @return decimal(10,2)
*/
  public function getDISCOUNT(){
    return $this->dISCOUNT;

  }

/**
* function to set the value of tOTAL
* @param tOTAL : value to set
*/
  public function setTOTAL($tOTAL){
    $this->tOTAL=$tOTAL;

  }

/**
* function to get the value of tOTAL
* @return decimal(10,2)
*/
  public function getTOTAL(){
    return $this->tOTAL;

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
