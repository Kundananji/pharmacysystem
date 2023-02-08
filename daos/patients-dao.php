<?php
class PatientsDao{

/**
* function to insert single object of type Patients into database
* @param object instance of type Patients
* @return inserted objected of type Patients
*/
  public function insert($patients){
    $patientId=  $patients->getPatientId();
    $fileId=  $patients->getFileId();
    $firstName=  $patients->getFirstName();
    $otherNames=  $patients->getOtherNames();
    $lastName=  $patients->getLastName();
    $address=  $patients->getAddress();
    $contactNumber=  $patients->getContactNumber();
    $dateOfBirth=  $patients->getDateOfBirth();
    $nationality=  $patients->getNationality();
    $status=  $patients->getStatus();
    try{
      $sql="INSERT INTO patients(`patientId`,`fileId`,`firstName`,`otherNames`,`lastName`,`address`,`contactNumber`,`dateOfBirth`,`nationality`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issssssssi",$patientId,$fileId,$firstName,$otherNames,$lastName,$address,$contactNumber,$dateOfBirth,$nationality,$status);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM patients WHERE `patientId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedPatients = $this->getFields($row);
        $stmt->close();
        return $insertedPatients;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Patients
* @param object instance of type Patients
* @return updated objected of type Patients
*/
  public function update($patients){
    $patientId=  $patients->getPatientId();
    $fileId=  $patients->getFileId();
    $firstName=  $patients->getFirstName();
    $otherNames=  $patients->getOtherNames();
    $lastName=  $patients->getLastName();
    $address=  $patients->getAddress();
    $contactNumber=  $patients->getContactNumber();
    $dateOfBirth=  $patients->getDateOfBirth();
    $nationality=  $patients->getNationality();
    $status=  $patients->getStatus();
    try{
      $sql="UPDATE patients SET `fileId`=?,`firstName`=?,`otherNames`=?,`lastName`=?,`address`=?,`contactNumber`=?,`dateOfBirth`=?,`nationality`=?,`status`=? WHERE patientId =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssssssssii",$fileId,$firstName,$otherNames,$lastName,$address,$contactNumber,$dateOfBirth,$nationality,$status,$patientId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM patients WHERE `patientId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedPatients = $this->getFields($row);
        $stmt->close();
        return $updatedPatients;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Patients from database through the provided search term
* @return array of objects of type Patients
*/
  public function search($term,$searchFields,$extra=null,$pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    //search through search fields
    $whereClause=[];
    foreach($searchFields as $searchField){
      $whereClause[]=$searchField.' LIKE \'%'.$term.'%\'';
    }
    try{
      $sql="SELECT * FROM patients WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patients = $this->getFields($row);
        $objects[]=$patients;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Patients from database
* @return array of objects of type Patients
*/
  public function selectAll($pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    try{
      $sql="SELECT * FROM patients $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patients = $this->getFields($row);
        $objects[]=$patients;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Patients from database
* @return object of type Patients
*/
  public function select($patientsId){
    try{
      $sql="SELECT * FROM `patients` WHERE `patientId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientsId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $patients = $this->getFields($row);
        return $patients;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Patients from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Patients
*/
  public function selectBy($fields,$values,$types,$orderByFields=array(),$pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    //validate variables
    if(sizeof($fields) == 0){
       throw new Exception("Fields should be passed"); //exit function to prevent catastrophy;
    }

    if(sizeof($fields)!=sizeof($values) && sizeof($fields)!=sizeof($types)){
       throw new Exception("Number of fields should match number of values and value types"); //exit function to prevent catastrophy;
    }

    $whereVars =array();

    //loop through each field to create a condition for where
    $fieldCount=0;
    foreach($fields as $field){
      $whereVars[]="$field='".$values[$fieldCount]."'";
      $fieldCount+=1;
    }

    try{
      $sql="SELECT * FROM patients  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patients = $this->getFields($row);
        $objects[]=$patients;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Patients from database
* @return boolean
*/
  public function delete($patientsId){
    try{
      $sql="DELETE FROM `patients` WHERE `patientId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientsId);
      $stmt->execute();
      $numRows = $stmt->affected_rows;
      $stmt->close();
      return $numRows>0;
    }
    catch(Exception $ex){
      return false;
    }

  }

/**
* function to select array of object of type Patients from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Patients
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM patients  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patients = $this->getFields($row);
        $objects[]=$patients;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to execute custom select array of records
* @param values: $query to execute.
* @return array of records fetched
*/
  public function selectQuery($query){
    try{
      $sql="$query";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows = array();
      while($row=$result->fetch_assoc()){
         $rows[] =$row;
      }
      $stmt->close();
      return $rows;
    }
    catch(Exception $ex){
      throw $ex;
    }
    return null;

  }

/**
* function to select array of object of type Patients from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Patients
*/
  public function getFields($row){
    $patients= new Patients();
      $patients->setPatientId($row['patientId']);
      $patients->setFileId($row['fileId']);
      $patients->setFirstName($row['firstName']);
      $patients->setOtherNames($row['otherNames']);
      $patients->setLastName($row['lastName']);
      $patients->setAddress($row['address']);
      $patients->setContactNumber($row['contactNumber']);
      $patients->setDateOfBirth($row['dateOfBirth']);
      $patients->setNationality($row['nationality']);
      $patients->setStatus($row['status']);
    return $patients;
  }
}
