<?php
class InvoiceSettings implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $terms;
  private $taxRate;

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
* @return int(10)
*/
  public function getId(){
    return $this->id;

  }

/**
* function to set the value of terms
* @param terms : value to set
*/
  public function setTerms($terms){
    $this->terms=$terms;

  }

/**
* function to get the value of terms
* @return text
*/
  public function getTerms(){
    return $this->terms;

  }

/**
* function to set the value of taxRate
* @param taxRate : value to set
*/
  public function setTaxRate($taxRate){
    $this->taxRate=$taxRate;

  }

/**
* function to get the value of taxRate
* @return decimal(10,1)
*/
  public function getTaxRate(){
    return $this->taxRate;

  }

/**
* function to get the string value of  InvoiceSettings
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->terms.' | '.$this->taxRate;

  }

/**
* function to get the json equivalent of  InvoiceSettings
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
