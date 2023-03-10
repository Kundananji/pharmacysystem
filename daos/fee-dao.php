<?php
class FeeDao{

/**
* function to insert single object of type Fee into database
* @param object instance of type Fee
* @return inserted objected of type Fee
*/
  public function insert($fee){
    $feeId=  $fee->getFeeId();
    $name=  $fee->getName();
    $description=  $fee->getDescription();
    $feeCategoryId=  $fee->getFeeCategoryId();
    $amount=  $fee->getAmount();
    $status=  $fee->getStatus();
    try{
      $sql="INSERT INTO fee(`feeId`,`name`,`description`,`feeCategoryId`,`amount`,`status`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issisi",$feeId,$name,$description,$feeCategoryId,$amount,$status);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM fee WHERE `feeId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedFee = $this->getFields($row);
        $stmt->close();
        return $insertedFee;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Fee
* @param object instance of type Fee
* @return updated objected of type Fee
*/
  public function update($fee){
    $feeId=  $fee->getFeeId();
    $name=  $fee->getName();
    $description=  $fee->getDescription();
    $feeCategoryId=  $fee->getFeeCategoryId();
    $amount=  $fee->getAmount();
    $status=  $fee->getStatus();
    try{
      $sql="UPDATE fee SET `name`=?,`description`=?,`feeCategoryId`=?,`amount`=?,`status`=? WHERE feeId =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssisii",$name,$description,$feeCategoryId,$amount,$status,$feeId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM fee WHERE `feeId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$feeId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedFee = $this->getFields($row);
        $stmt->close();
        return $updatedFee;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Fee from database through the provided search term
* @return array of objects of type Fee
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
      $sql="SELECT * FROM fee WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $fee = $this->getFields($row);
        $objects[]=$fee;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Fee from database
* @return array of objects of type Fee
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
      $sql="SELECT * FROM fee $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $fee = $this->getFields($row);
        $objects[]=$fee;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Fee from database
* @return object of type Fee
*/
  public function select($feeId){
    try{
      $sql="SELECT * FROM `fee` WHERE `feeId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$feeId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $fee = $this->getFields($row);
        return $fee;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Fee from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Fee
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
      $sql="SELECT * FROM fee  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $fee = $this->getFields($row);
        $objects[]=$fee;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Fee from database
* @return boolean
*/
  public function delete($feeId){
    try{
      $sql="DELETE FROM `fee` WHERE `feeId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$feeId);
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
* function to select array of object of type Fee from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Fee
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM fee  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $fee = $this->getFields($row);
        $objects[]=$fee;
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
* function to select array of object of type Fee from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Fee
*/
  public function getFields($row){
    $fee= new Fee();
      $fee->setFeeId($row['feeId']);
      $fee->setName($row['name']);
      $fee->setDescription($row['description']);
      $fee->setFeeCategoryId($row['feeCategoryId']);
      $fee->setAmount($row['amount']);
      $fee->setStatus($row['status']);
    return $fee;
  }
}
