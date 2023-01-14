<?php
class AlternativeProfile implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $userId;
  private $profileId;

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
* function to set the value of profileId
* @param profileId : value to set
*/
  public function setProfileId($profileId){
    $this->profileId=$profileId;

  }

/**
* function to get the value of profileId
* @return int(11)
*/
  public function getProfileId(){
    return $this->profileId;

  }

/**
* function to get the string value of  AlternativeProfile
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->userId.' | '.$this->profileId;

  }

/**
* function to get the json equivalent of  AlternativeProfile
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
