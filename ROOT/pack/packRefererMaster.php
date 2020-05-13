<?php
include_once "../main/common.php";
include_once "pack.php";


if(($method==='GET')&&(AGENCY_ID)){


function refMaster($ref,$AGENCY_ID,$WHERE="1=1"){

 	$sql = " SELECT ";


	    foreach ( $ref as $key=>$value){

	             $sql = $sql." ".$value." AS ".$key.",";
	    }


 	  $sql.=" '' as '' FROM   form008 ref WHERE  ref.dato40 in (".$AGENCY_ID.") and ".$WHERE." and ref.archived = 'no' ";

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}


$database['ref']  = refMaster($REFERER,AGENCY_ID);   
  

echo json_encode($database); 
exit;


}

       
?>