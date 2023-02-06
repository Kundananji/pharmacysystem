<?php
class MedicinesStockDao{

/**
* function to insert single object of type MedicinesStock into database
* @param object instance of type MedicinesStock
* @return inserted objected of type MedicinesStock
*/
  public function insert($medicinesStock){
    $id=  $medicinesStock->getId();
    $medicineId=  $medicinesStock->getMedicineId();
    $batchId=  $medicinesStock->getBatchId();
    $expiryDate=  $medicinesStock->getExpiryDate();
    $quantity=  $medicinesStock->getQuantity();
    $amount=  $medicinesStock->getAmount();
    try{
      $sql="INSERT INTO medicines_stock(`id`,`medicineId`,`batch_id`,`expiry_date`,`quantity`,`amount`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iissis",$id,$medicineId,$batchId,$expiryDate,$quantity,$amount);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM medicines_stock WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedMedicinesStock = $this->getFields($row);
        $stmt->close();
        return $insertedMedicinesStock;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type MedicinesStock
* @param object instance of type MedicinesStock
* @return updated objected of type MedicinesStock
*/
  public function update($medicinesStock){
    $id=  $medicinesStock->getId();
    $medicineId=  $medicinesStock->getMedicineId();
    $batchId=  $medicinesStock->getBatchId();
    $expiryDate=  $medicinesStock->getExpiryDate();
    $quantity=  $medicinesStock->getQuantity();
    $amount=  $medicinesStock->getAmount();
    try{
      $sql="UPDATE medicines_stock SET `medicineId`=?,`batch_id`=?,`expiry_date`=?,`quantity`=?,`amount`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issisi",$medicineId,$batchId,$expiryDate,$quantity,$amount,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM medicines_stock WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedMedicinesStock = $this->getFields($row);
        $stmt->close();
        return $updatedMedicinesStock;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type MedicinesStock from database through the provided search term
* @return array of objects of type MedicinesStock
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
      $sql="SELECT * FROM medicines_stock WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $medicinesStock = $this->getFields($row);
        $objects[]=$medicinesStock;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type MedicinesStock from database
* @return array of objects of type MedicinesStock
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
      $sql="SELECT * FROM medicines_stock $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $medicinesStock = $this->getFields($row);
        $objects[]=$medicinesStock;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type MedicinesStock from database
* @return object of type MedicinesStock
*/
  public function select($medicinesStockId){
    try{
      $sql="SELECT * FROM `medicines_stock` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$medicinesStockId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $medicinesStock = $this->getFields($row);
        return $medicinesStock;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type MedicinesStock from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type MedicinesStock
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
      $sql="SELECT * FROM medicines_stock  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $medicinesStock = $this->getFields($row);
        $objects[]=$medicinesStock;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type MedicinesStock from database
* @return boolean
*/
  public function delete($medicinesStockId){
    try{
      $sql="DELETE FROM `medicines_stock` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$medicinesStockId);
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
* function to select array of object of type MedicinesStock from database
* @param values: whereClause containing search conditions.
* @return array of objects of type MedicinesStock
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM medicines_stock  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $medicinesStock = $this->getFields($row);
        $objects[]=$medicinesStock;
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
* function to select array of object of type MedicinesStock from database
* @param values: whereClause containing search conditions.
* @return array of objects of type MedicinesStock
*/
  public function getFields($row){
    $medicinesStock= new MedicinesStock();
      $medicinesStock->setId($row['id']);
      $medicinesStock->setMedicineId($row['medicineId']);
      $medicinesStock->setBatchId($row['batch_id']);
      $medicinesStock->setExpiryDate($row['expiry_date']);
      $medicinesStock->setQuantity($row['quantity']);
      $medicinesStock->setAmount($row['amount']);
    return $medicinesStock;
  }
}
