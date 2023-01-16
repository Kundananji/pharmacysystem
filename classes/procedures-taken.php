<?php
class ProceduresTaken implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $patientId;
  private $department;
  private $procedureConducted;
  private $resultsDetails;
  private $doctorsName;
  private $labTech;
  private $fee;
  private $timeTested;

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
* function to set the value of patientId
* @param patientId : value to set
*/
  public function setPatientId($patientId){
    $this->patientId=$patientId;

  }

/**
* function to get the value of patientId
* @return String
*/
  public function getPatientId(){
    return $this->patientId;

  }

/**
* function to set the value of department
* @param department : value to set
*/
  public function setDepartment($department){
    $this->department=$department;

  }

/**
* function to get the value of department
* @return String
*/
  public function getDepartment(){
    return $this->department;

  }

/**
* function to set the value of procedureConducted
* @param procedureConducted : value to set
*/
  public function setProcedureConducted($procedureConducted){
    $this->procedureConducted=$procedureConducted;

  }

/**
* function to get the value of procedureConducted
* @return String
*/
  public function getProcedureConducted(){
    return $this->procedureConducted;

  }

/**
* function to set the value of resultsDetails
* @param resultsDetails : value to set
*/
  public function setResultsDetails($resultsDetails){
    $this->resultsDetails=$resultsDetails;

  }

/**
* function to get the value of resultsDetails
* @return text
*/
  public function getResultsDetails(){
    return $this->resultsDetails;

  }

/**
* function to set the value of doctorsName
* @param doctorsName : value to set
*/
  public function setDoctorsName($doctorsName){
    $this->doctorsName=$doctorsName;

  }

/**
* function to get the value of doctorsName
* @return String
*/
  public function getDoctorsName(){
    return $this->doctorsName;

  }

/**
* function to set the value of labTech
* @param labTech : value to set
*/
  public function setLabTech($labTech){
    $this->labTech=$labTech;

  }

/**
* function to get the value of labTech
* @return String
*/
  public function getLabTech(){
    return $this->labTech;

  }

/**
* function to set the value of fee
* @param fee : value to set
*/
  public function setFee($fee){
    $this->fee=$fee;

  }

/**
* function to get the value of fee
* @return int(10)
*/
  public function getFee(){
    return $this->fee;

  }

/**
* function to set the value of timeTested
* @param timeTested : value to set
*/
  public function setTimeTested($timeTested){
    $this->timeTested=$timeTested;

  }

/**
* function to get the value of timeTested
* @return datetime
*/
  public function getTimeTested(){
    return $this->timeTested;

  }

/**
* function to get the string value of  ProceduresTaken
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->patientId.' | '.$this->department.' | '.$this->procedureConducted;

  }

/**
* function to get the json equivalent of  ProceduresTaken
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
