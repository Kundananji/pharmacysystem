<?php
class RegularCheckups implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $patientId;
  private $conductedBy;
  private $temperature;
  private $bloodPressure;
  private $weight;
  private $other;
  private $dateTaken;
  private $timeTaken;

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
* function to set the value of temperature
* @param temperature : value to set
*/
  public function setTemperature($temperature){
    $this->temperature=$temperature;

  }

/**
* function to get the value of temperature
* @return String
*/
  public function getTemperature(){
    return $this->temperature;

  }

/**
* function to set the value of bloodPressure
* @param bloodPressure : value to set
*/
  public function setBloodPressure($bloodPressure){
    $this->bloodPressure=$bloodPressure;

  }

/**
* function to get the value of bloodPressure
* @return String
*/
  public function getBloodPressure(){
    return $this->bloodPressure;

  }

/**
* function to set the value of weight
* @param weight : value to set
*/
  public function setWeight($weight){
    $this->weight=$weight;

  }

/**
* function to get the value of weight
* @return String
*/
  public function getWeight(){
    return $this->weight;

  }

/**
* function to set the value of other
* @param other : value to set
*/
  public function setOther($other){
    $this->other=$other;

  }

/**
* function to get the value of other
* @return text
*/
  public function getOther(){
    return $this->other;

  }

/**
* function to set the value of dateTaken
* @param dateTaken : value to set
*/
  public function setDateTaken($dateTaken){
    $this->dateTaken=$dateTaken;

  }

/**
* function to get the value of dateTaken
* @return date
*/
  public function getDateTaken(){
    return $this->dateTaken;

  }

/**
* function to set the value of timeTaken
* @param timeTaken : value to set
*/
  public function setTimeTaken($timeTaken){
    $this->timeTaken=$timeTaken;

  }

/**
* function to get the value of timeTaken
* @return time
*/
  public function getTimeTaken(){
    return $this->timeTaken;

  }

/**
* function to get the string value of  RegularCheckups
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->patientId.' | '.$this->conductedBy.' | '.$this->temperature;

  }

/**
* function to get the json equivalent of  RegularCheckups
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
