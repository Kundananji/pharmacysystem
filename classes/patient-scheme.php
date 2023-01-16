<?php
class PatientScheme implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $name;
  private $description;
  private $patientId;
  private $insuranceProviderId;
  private $status;

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
* function to set the value of insuranceProviderId
* @param insuranceProviderId : value to set
*/
  public function setInsuranceProviderId($insuranceProviderId){
    $this->insuranceProviderId=$insuranceProviderId;

  }

/**
* function to get the value of insuranceProviderId
* @return int(10)
*/
  public function getInsuranceProviderId(){
    return $this->insuranceProviderId;

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
* function to get the string value of  PatientScheme
* @return string
*/
  public function toString(){
    return $this->name;

  }

/**
* function to get the json equivalent of  PatientScheme
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
