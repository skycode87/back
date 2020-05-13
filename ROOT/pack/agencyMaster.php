<?php
include_once "../main/common.php";
include_once "../main/agency.php";


if(($method==='GET')&&(AGENCY_ID)){

  
     $database = master(_agency_,'agency','null','null',$AGENCY,AGENCY_ID,'id in ('.AGENCY_ID.')');

     echo json_encode($database[0]); 


    exit;

}

       
?>