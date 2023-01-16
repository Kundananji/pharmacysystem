<?php
class StaffDao{

/**
* function to insert single object of type Staff into database
* @param object instance of type Staff
* @return inserted objected of type Staff
*/
  public function insert($staff){
    $id=  $staff->getId();
    $name=  $staff->getName();
    $title=  $staff->getTitle();
    $position=  $staff->getPosition();
    $phoneNumber=  $staff->getPhoneNumber();
    $address=  $staff->getAddress();
    $nationaility=  $staff->getNationaility();
    $status=  $staff->getStatus();
    $manNo=  $staff->getManNo();
    try{
      $sql="INSERT INTO staff(`id`,`name`,`title`,`position`,`phoneNumber`,`address`,`nationaility`,`status`,`manNo`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ississsis",$id,$name,$title,$position,$phoneNumber,$address,$nationaility,$status,$manNo);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM staff WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedStaff = $this->getFields($row);
        $stmt->close();
        return $insertedStaff;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Staff
* @param object instance of type Staff
* @return updated objected of type Staff
*/
  public function update($staff){
    $id=  $staff->getId();
    $name=  $staff->getName();
    $title=  $staff->getTitle();
    $position=  $staff->getPosition();
    $phoneNumber=  $staff->getPhoneNumber();
    $address=  $staff->getAddress();
    $nationaility=  $staff->getNationaility();
    $status=  $staff->getStatus();
    $manNo=  $staff->getManNo();
    try{
      $sql="UPDATE staff SET `name`=?,`title`=?,`position`=?,`phoneNumber`=?,`address`=?,`nationaility`=?,`status`=?,`manNo`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssisssisi",$name,$title,$position,$phoneNumber,$address,$nationaility,$status,$manNo,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM staff WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedStaff = $this->getFields($row);
        $stmt->close();
        return $updatedStaff;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Staff from database through the provided search term
* @return array of objects of type Staff
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
      $sql="SELECT * FROM staff WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $staff = $this->getFields($row);
        $objects[]=$staff;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Staff from database
* @return array of objects of type Staff
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
      $sql="SELECT * FROM staff $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $staff = $this->getFields($row);
        $objects[]=$staff;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Staff from database
* @return object of type Staff
*/
  public function select($staffId){
    try{
      $sql="SELECT * FROM `staff` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$staffId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $staff = $this->getFields($row);
        return $staff;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Staff from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Staff
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
      $sql="SELECT * FROM staff  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $staff = $this->getFields($row);
        $objects[]=$staff;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Staff from database
* @return boolean
*/
  public function delete($staffId){
    try{
      $sql="DELETE FROM `staff` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$staffId);
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
* function to select array of object of type Staff from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Staff
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM staff  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $staff = $this->getFields($row);
        $objects[]=$staff;
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
* function to select array of object of type Staff from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Staff
*/
  public function getFields($row){
    $staff= new Staff();
      $staff->setId($row['id']);
      $staff->setName($row['name']);
      $staff->setTitle($row['title']);
      $staff->setPosition($row['position']);
      $staff->setPhoneNumber($row['phoneNumber']);
      $staff->setAddress($row['address']);
      $staff->setNationaility($row['nationaility']);
      $staff->setStatus($row['status']);
      $staff->setManNo($row['manNo']);
    return $staff;
  }
}
