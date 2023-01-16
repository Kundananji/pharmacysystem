<?php
class RegularCheckupsDao{

/**
* function to insert single object of type RegularCheckups into database
* @param object instance of type RegularCheckups
* @return inserted objected of type RegularCheckups
*/
  public function insert($regularCheckups){
    $id=  $regularCheckups->getId();
    $patientId=  $regularCheckups->getPatientId();
    $temperature=  $regularCheckups->getTemperature();
    $bloodPressure=  $regularCheckups->getBloodPressure();
    $weight=  $regularCheckups->getWeight();
    $other=  $regularCheckups->getOther();
    $status=  $regularCheckups->getStatus();
    $timeTested=  $regularCheckups->getTimeTested();
    try{
      $sql="INSERT INTO regular_checkups(`id`,`patient_id`,`temperature`,`bloodPressure`,`weight`,`other`,`status`,`timeTested`) VALUES(?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isssssis",$id,$patientId,$temperature,$bloodPressure,$weight,$other,$status,$timeTested);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM regular_checkups WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedRegularCheckups = $this->getFields($row);
        $stmt->close();
        return $insertedRegularCheckups;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type RegularCheckups
* @param object instance of type RegularCheckups
* @return updated objected of type RegularCheckups
*/
  public function update($regularCheckups){
    $id=  $regularCheckups->getId();
    $patientId=  $regularCheckups->getPatientId();
    $temperature=  $regularCheckups->getTemperature();
    $bloodPressure=  $regularCheckups->getBloodPressure();
    $weight=  $regularCheckups->getWeight();
    $other=  $regularCheckups->getOther();
    $status=  $regularCheckups->getStatus();
    $timeTested=  $regularCheckups->getTimeTested();
    try{
      $sql="UPDATE regular_checkups SET `patient_id`=?,`temperature`=?,`bloodPressure`=?,`weight`=?,`other`=?,`status`=?,`timeTested`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sssssisi",$patientId,$temperature,$bloodPressure,$weight,$other,$status,$timeTested,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM regular_checkups WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedRegularCheckups = $this->getFields($row);
        $stmt->close();
        return $updatedRegularCheckups;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type RegularCheckups from database through the provided search term
* @return array of objects of type RegularCheckups
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
      $sql="SELECT * FROM regular_checkups WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $regularCheckups = $this->getFields($row);
        $objects[]=$regularCheckups;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type RegularCheckups from database
* @return array of objects of type RegularCheckups
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
      $sql="SELECT * FROM regular_checkups $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $regularCheckups = $this->getFields($row);
        $objects[]=$regularCheckups;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type RegularCheckups from database
* @return object of type RegularCheckups
*/
  public function select($regularCheckupsId){
    try{
      $sql="SELECT * FROM `regular_checkups` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$regularCheckupsId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $regularCheckups = $this->getFields($row);
        return $regularCheckups;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type RegularCheckups from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type RegularCheckups
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
      $sql="SELECT * FROM regular_checkups  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $regularCheckups = $this->getFields($row);
        $objects[]=$regularCheckups;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type RegularCheckups from database
* @return boolean
*/
  public function delete($regularCheckupsId){
    try{
      $sql="DELETE FROM `regular_checkups` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$regularCheckupsId);
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
* function to select array of object of type RegularCheckups from database
* @param values: whereClause containing search conditions.
* @return array of objects of type RegularCheckups
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM regular_checkups  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $regularCheckups = $this->getFields($row);
        $objects[]=$regularCheckups;
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
* function to select array of object of type RegularCheckups from database
* @param values: whereClause containing search conditions.
* @return array of objects of type RegularCheckups
*/
  public function getFields($row){
    $regularCheckups= new RegularCheckups();
      $regularCheckups->setId($row['id']);
      $regularCheckups->setPatientId($row['patient_id']);
      $regularCheckups->setTemperature($row['temperature']);
      $regularCheckups->setBloodPressure($row['bloodPressure']);
      $regularCheckups->setWeight($row['weight']);
      $regularCheckups->setOther($row['other']);
      $regularCheckups->setStatus($row['status']);
      $regularCheckups->setTimeTested($row['timeTested']);
    return $regularCheckups;
  }
}
