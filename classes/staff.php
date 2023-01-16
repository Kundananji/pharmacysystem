<?php
class Staff implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $title;
  private $position;
  private $phoneNumber;
  private $address;
  private $nationaility;
  private $status;
  private $manNo;

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
* function to set the value of title
* @param title : value to set
*/
  public function setTitle($title){
    $this->title=$title;

  }

/**
* function to get the value of title
* @return String
*/
  public function getTitle(){
    return $this->title;

  }

/**
* function to set the value of position
* @param position : value to set
*/
  public function setPosition($position){
    $this->position=$position;

  }

/**
* function to get the value of position
* @return int(10)
*/
  public function getPosition(){
    return $this->position;

  }

/**
* function to set the value of phoneNumber
* @param phoneNumber : value to set
*/
  public function setPhoneNumber($phoneNumber){
    $this->phoneNumber=$phoneNumber;

  }

/**
* function to get the value of phoneNumber
* @return String
*/
  public function getPhoneNumber(){
    return $this->phoneNumber;

  }

/**
* function to set the value of address
* @param address : value to set
*/
  public function setAddress($address){
    $this->address=$address;

  }

/**
* function to get the value of address
* @return text
*/
  public function getAddress(){
    return $this->address;

  }

/**
* function to set the value of nationaility
* @param nationaility : value to set
*/
  public function setNationaility($nationaility){
    $this->nationaility=$nationaility;

  }

/**
* function to get the value of nationaility
* @return String
*/
  public function getNationaility(){
    return $this->nationaility;

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
* @return int(10)
*/
  public function getStatus(){
    return $this->status;

  }

/**
* function to set the value of manNo
* @param manNo : value to set
*/
  public function setManNo($manNo){
    $this->manNo=$manNo;

  }

/**
* function to get the value of manNo
* @return String
*/
  public function getManNo(){
    return $this->manNo;

  }

/**
* function to get the string value of  Staff
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  Staff
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
