<?php
class ProceduresTakenDao{

/**
* function to insert single object of type ProceduresTaken into database
* @param object instance of type ProceduresTaken
* @return inserted objected of type ProceduresTaken
*/
  public function insert($proceduresTaken){
    $id=  $proceduresTaken->getId();
    $patientId=  $proceduresTaken->getPatientId();
    $procedureId=  $proceduresTaken->getProcedureId();
    $doctorId=  $proceduresTaken->getDoctorId();
    $conductedBy=  $proceduresTaken->getConductedBy();
    $resultsDetails=  $proceduresTaken->getResultsDetails();
    $remarks=  $proceduresTaken->getRemarks();
    $dateConducted=  $proceduresTaken->getDateConducted();
    $timeConducted=  $proceduresTaken->getTimeConducted();
    try{
      $sql="INSERT INTO procedures_taken(`id`,`patientId`,`procedureId`,`doctorId`,`conductedBy`,`resultsDetails`,`remarks`,`dateConducted`,`timeConducted`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiiiissss",$id,$patientId,$procedureId,$doctorId,$conductedBy,$resultsDetails,$remarks,$dateConducted,$timeConducted);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM procedures_taken WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedProceduresTaken = $this->getFields($row);
        $stmt->close();
        return $insertedProceduresTaken;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type ProceduresTaken
* @param object instance of type ProceduresTaken
* @return updated objected of type ProceduresTaken
*/
  public function update($proceduresTaken){
    $id=  $proceduresTaken->getId();
    $patientId=  $proceduresTaken->getPatientId();
    $procedureId=  $proceduresTaken->getProcedureId();
    $doctorId=  $proceduresTaken->getDoctorId();
    $conductedBy=  $proceduresTaken->getConductedBy();
    $resultsDetails=  $proceduresTaken->getResultsDetails();
    $remarks=  $proceduresTaken->getRemarks();
    $dateConducted=  $proceduresTaken->getDateConducted();
    $timeConducted=  $proceduresTaken->getTimeConducted();
    try{
      $sql="UPDATE procedures_taken SET `patientId`=?,`procedureId`=?,`doctorId`=?,`conductedBy`=?,`resultsDetails`=?,`remarks`=?,`dateConducted`=?,`timeConducted`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiiissssi",$patientId,$procedureId,$doctorId,$conductedBy,$resultsDetails,$remarks,$dateConducted,$timeConducted,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM procedures_taken WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedProceduresTaken = $this->getFields($row);
        $stmt->close();
        return $updatedProceduresTaken;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type ProceduresTaken from database through the provided search term
* @return array of objects of type ProceduresTaken
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
      $sql="SELECT * FROM procedures_taken WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $proceduresTaken = $this->getFields($row);
        $objects[]=$proceduresTaken;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type ProceduresTaken from database
* @return array of objects of type ProceduresTaken
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
      $sql="SELECT * FROM procedures_taken $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $proceduresTaken = $this->getFields($row);
        $objects[]=$proceduresTaken;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type ProceduresTaken from database
* @return object of type ProceduresTaken
*/
  public function select($proceduresTakenId){
    try{
      $sql="SELECT * FROM `procedures_taken` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$proceduresTakenId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $proceduresTaken = $this->getFields($row);
        return $proceduresTaken;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type ProceduresTaken from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type ProceduresTaken
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
      $sql="SELECT * FROM procedures_taken  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $proceduresTaken = $this->getFields($row);
        $objects[]=$proceduresTaken;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type ProceduresTaken from database
* @return boolean
*/
  public function delete($proceduresTakenId){
    try{
      $sql="DELETE FROM `procedures_taken` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$proceduresTakenId);
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
* function to select array of object of type ProceduresTaken from database
* @param values: whereClause containing search conditions.
* @return array of objects of type ProceduresTaken
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM procedures_taken  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $proceduresTaken = $this->getFields($row);
        $objects[]=$proceduresTaken;
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
* function to select array of object of type ProceduresTaken from database
* @param values: whereClause containing search conditions.
* @return array of objects of type ProceduresTaken
*/
  public function getFields($row){
    $proceduresTaken= new ProceduresTaken();
      $proceduresTaken->setId($row['id']);
      $proceduresTaken->setPatientId($row['patientId']);
      $proceduresTaken->setProcedureId($row['procedureId']);
      $proceduresTaken->setDoctorId($row['doctorId']);
      $proceduresTaken->setConductedBy($row['conductedBy']);
      $proceduresTaken->setResultsDetails($row['resultsDetails']);
      $proceduresTaken->setRemarks($row['remarks']);
      $proceduresTaken->setDateConducted($row['dateConducted']);
      $proceduresTaken->setTimeConducted($row['timeConducted']);
    return $proceduresTaken;
  }
}
