<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once "../main/common.php";
include_once "pack.php";


function PacksByAgency($agency,$filter,$limit,$noshow){

  if($filter=='all'){
    $filter__ = "1=1";
  }else{
    $filter__ = "pack.dato32 like ('%".$filter."%')";
  }

   $sql = "SELECT       
        pack.dato01     AS 'pack_name',
        pack.dato03     AS 'pack_duration',
        pack.dato08     AS 'pack_price',
        pack.dato13     AS 'pack_departure',                        
        pack.dato30     AS 'pack_gallery',
        pack.dato31     AS 'pack_avatar',
        pack.dato32     AS 'pack_category',
        pack.dato14     AS 'pack_url'
FROM    form004 pack 
WHERE  ( ".$filter__.")
       AND pack.dato10 = '0'
       AND pack.dato01 not like ('".$noshow."')
       AND pack.dato45 in ('".$agency."')
       AND pack.archived='no' LIMIT ".$limit;

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();   
      return $res;
}


if(($method==='GET')){

      //FindBy__($table,$campo,$id,$select,$type="single"){
    $database['packs'] = PacksByAgency(1,$request[0],$request[1],$request[2]);
    echo json_encode($database);

return 0;
exit;
}

?>