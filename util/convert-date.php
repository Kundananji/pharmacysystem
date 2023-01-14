<?php
function convertDate($date){
    $dateParts = explode("/",$date);
    //reverse date
    if(sizeof($dateParts)<3){
        return $date; //can't convert invalid date
    }
    return $dateParts[2].'-'.$dateParts[1].'-'.$dateParts[0];
     
}