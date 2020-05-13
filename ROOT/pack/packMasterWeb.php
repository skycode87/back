<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once "../main/common.php";
include_once "pack.php";


function packMaster($select,$pack,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";
    
    $ROW = explode(",",$select);
  

     for($i=0;$i<count($ROW);$i++){

      $sql = $sql." ".$pack[$ROW[$i]]." AS ".$ROW[$i].",";
     
     }


    $sql.=" '' as '' FROM   form004 pack WHERE pack.dato45 in (".$AGENCY_ID.")  and ".$WHERE." and pack.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}

  
 $filter__ = " pack.dato10 in (0)  "; 
 
 if($request[0]){
  $filter__+= " and  pack.dato01 like ('%".$filter."%') OR  pack.dato32 like ('%".htmlentities($filter)."%')";
 } 



if(($method==='GET')){
  $agencyID          = objectID(_agency_,$action);
  $database['packs'] =  packMaster('pack_price,pack_avatar,pack_url,pack_duration,pack_name',$PACK,$agencyID,$filter__);   
  echo json_encode($database);
  exit;
}
?>








