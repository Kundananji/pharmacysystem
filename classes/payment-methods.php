<?php
class PaymentMethods implements \JsonSerializable{

/**
* member variables
*/
  private $paymentMethodId;
  private $name;
  private $description;
  private $status;

/**
* function to initialize object
*/
  function __construct(){

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
* @return int(11)
*/
  public function getPaymentMethodId(){
    return $this->paymentMethodId;

  }

/**
* function to set the value of name
* @param name : value to set
*/
  public function setName($name){
    $this->name=$name;

  }

/**
* function to get the value of name
* @return String
*/
  public function getName(){
    return $this->name;

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
* function to set the value of status
* @param status : value to set
*/
  public function setStatus($status){
    $this->status=$status;

  }

/**
* function to get the value of status
* @return int(11)
*/
  public function getStatus(){
    return $this->status;

  }

/**
* function to get the string value of  PaymentMethods
* @return string
*/
  public function toString(){
    return $this->name;
    return ;

  }

/**
* function to get the json equivalent of  PaymentMethods
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
