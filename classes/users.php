<?php
class Users implements \JsonSerializable{

/**
* member variables
*/
  private $id;
  private $username;
  private $firstName;
  private $lastName;
  private $password;
  private $address;
  private $email;
  private $contactNumber;
  private $isLoggedIn;
  private $status;
  private $profile;

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
* function to set the value of username
* @param username : value to set
*/
  public function setUsername($username){
    $this->username=$username;

  }

/**
* function to get the value of username
* @return String
*/
  public function getUsername(){
    return $this->username;

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
* function to set the value of password
* @param password : value to set
*/
  public function setPassword($password){
    $this->password=$password;

  }

/**
* function to get the value of password
* @return String
*/
  public function getPassword(){
    return $this->password;

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
* function to set the value of email
* @param email : value to set
*/
  public function setEmail($email){
    $this->email=$email;

  }

/**
* function to get the value of email
* @return String
*/
  public function getEmail(){
    return $this->email;

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
* function to set the value of isLoggedIn
* @param isLoggedIn : value to set
*/
  public function setIsLoggedIn($isLoggedIn){
    $this->isLoggedIn=$isLoggedIn;

  }

/**
* function to get the value of isLoggedIn
* @return int(10)
*/
  public function getIsLoggedIn(){
    return $this->isLoggedIn;

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
* function to set the value of profile
* @param profile : value to set
*/
  public function setProfile($profile){
    $this->profile=$profile;

  }

/**
* function to get the value of profile
* @return int(11)
*/
  public function getProfile(){
    return $this->profile;

  }

/**
* function to get the string value of  Users
* @return string
*/
  public function toString(){
    return $this->id.' | '.$this->username.' | '.$this->firstName.' | '.$this->lastName;

  }

/**
* function to get the json equivalent of  Users
* @return json string
*/
  public function jsonSerialize(){
    return get_object_vars($this);

  }
}
