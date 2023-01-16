<?php
class RegularCheckups implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $patientId;
  private $temperature;
  private $bloodPressure;
  private $weight;
  private $other;
  private $status;
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
* function to get the string value of  RegularCheckups
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->patientId.' | '.$this->temperature.' | '.$this->bloodPressure;

  }

/**
* function to get the json equivalent of  RegularCheckups
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
