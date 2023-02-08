<?php
class Patients implements \JsonSerializable{

/**
* member variables
*/
  private $patientId;
  private $fileId;
  private $firstName;
  private $otherNames;
  private $lastName;
  private $address;
  private $contactNumber;
  private $dateOfBirth;
  private $nationality;
  private $status;

/**
* function to initialize object
*/
  function __construct(){

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
* function to set the value of fileId
* @param fileId : value to set
*/
  public function setFileId($fileId){
    $this->fileId=$fileId;

  }

/**
* function to get the value of fileId
* @return String
*/
  public function getFileId(){
    return $this->fileId;

  }

/**
* function to set the value of firstName
* @param firstName : value to set
*/
  public function setFirstName($firstName){
    $this->firstName=$firstName;

  }

/**
* function to get the value of firstName
* @return String
*/
  public function getFirstName(){
    return $this->firstName;

  }

/**
* function to set the value of otherNames
* @param otherNames : value to set
*/
  public function setOtherNames($otherNames){
    $this->otherNames=$otherNames;

  }

/**
* function to get the value of otherNames
* @return String
*/
  public function getOtherNames(){
    return $this->otherNames;

  }

/**
* function to set the value of lastName
* @param lastName : value to set
*/
  public function setLastName($lastName){
    $this->lastName=$lastName;

  }

/**
* function to get the value of lastName
* @return String
*/
  public function getLastName(){
    return $this->lastName;

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
* function to set the value of contactNumber
* @param contactNumber : value to set
*/
  public function setContactNumber($contactNumber){
    $this->contactNumber=$contactNumber;

  }

/**
* function to get the value of contactNumber
* @return String
*/
  public function getContactNumber(){
    return $this->contactNumber;

  }

/**
* function to set the value of dateOfBirth
* @param dateOfBirth : value to set
*/
  public function setDateOfBirth($dateOfBirth){
    $this->dateOfBirth=$dateOfBirth;

  }

/**
* function to get the value of dateOfBirth
* @return date
*/
  public function getDateOfBirth(){
    return $this->dateOfBirth;

  }

/**
* function to set the value of nationality
* @param nationality : value to set
*/
  public function setNationality($nationality){
    $this->nationality=$nationality;

  }

/**
* function to get the value of nationality
* @return String
*/
  public function getNationality(){
    return $this->nationality;

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
* function to get the string value of  Patients
* @return string
*/
  public function toString(){
    return $this->firstName.'&nbsp;'.$this->otherNames.'&nbsp;'.$this->lastName;

  }

/**
* function to get the json equivalent of  Patients
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
