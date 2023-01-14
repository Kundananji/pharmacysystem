<?php
class UserTokens implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $selector;
  private $hashedValidator;
  private $userId;
  private $expiry;

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
* function to set the value of selector
* @param selector : value to set
*/
  public function setSelector($selector){
    $this->selector=$selector;

  }

/**
* function to get the value of selector
* @return String
*/
  public function getSelector(){
    return $this->selector;

  }

/**
* function to set the value of hashedValidator
* @param hashedValidator : value to set
*/
  public function setHashedValidator($hashedValidator){
    $this->hashedValidator=$hashedValidator;

  }

/**
* function to get the value of hashedValidator
* @return String
*/
  public function getHashedValidator(){
    return $this->hashedValidator;

  }

/**
* function to set the value of userId
* @param userId : value to set
*/
  public function setUserId($userId){
    $this->userId=$userId;

  }

/**
* function to get the value of userId
* @return int(11)
*/
  public function getUserId(){
    return $this->userId;

  }

/**
* function to set the value of expiry
* @param expiry : value to set
*/
  public function setExpiry($expiry){
    $this->expiry=$expiry;

  }

/**
* function to get the value of expiry
* @return datetime
*/
  public function getExpiry(){
    return $this->expiry;

  }

/**
* function to get the string value of  UserTokens
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->selector.' | '.$this->hashedValidator.' | '.$this->userId;

  }

/**
* function to get the json equivalent of  UserTokens
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
