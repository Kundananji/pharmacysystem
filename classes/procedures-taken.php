<?php
class ProceduresTaken implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $patientId;
  private $procedureId;
  private $doctorId;
  private $conductedBy;
  private $resultsDetails;
  private $remarks;
  private $dateConducted;
  private $timeConducted;

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
* @return int(10)
*/
  public function getPatientId(){
    return $this->patientId;

  }

/**
* function to set the value of procedureId
* @param procedureId : value to set
*/
  public function setProcedureId($procedureId){
    $this->procedureId=$procedureId;

  }

/**
* function to get the value of procedureId
* @return int(10)
*/
  public function getProcedureId(){
    return $this->procedureId;

  }

/**
* function to set the value of doctorId
* @param doctorId : value to set
*/
  public function setDoctorId($doctorId){
    $this->doctorId=$doctorId;

  }

/**
* function to get the value of doctorId
* @return int(10)
*/
  public function getDoctorId(){
    return $this->doctorId;

  }

/**
* function to set the value of conductedBy
* @param conductedBy : value to set
*/
  public function setConductedBy($conductedBy){
    $this->conductedBy=$conductedBy;

  }

/**
* function to get the value of conductedBy
* @return int(10)
*/
  public function getConductedBy(){
    return $this->conductedBy;

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
* function to set the value of remarks
* @param remarks : value to set
*/
  public function setRemarks($remarks){
    $this->remarks=$remarks;

  }

/**
* function to get the value of remarks
* @return text
*/
  public function getRemarks(){
    return $this->remarks;

  }

/**
* function to set the value of dateConducted
* @param dateConducted : value to set
*/
  public function setDateConducted($dateConducted){
    $this->dateConducted=$dateConducted;

  }

/**
* function to get the value of dateConducted
* @return date
*/
  public function getDateConducted(){
    return $this->dateConducted;

  }

/**
* function to set the value of timeConducted
* @param timeConducted : value to set
*/
  public function setTimeConducted($timeConducted){
    $this->timeConducted=$timeConducted;

  }

/**
* function to get the value of timeConducted
* @return time
*/
  public function getTimeConducted(){
    return $this->timeConducted;

  }

/**
* function to get the string value of  ProceduresTaken
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->patientId.' | '.$this->procedureId.' | '.$this->doctorId;

  }

/**
* function to get the json equivalent of  ProceduresTaken
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
