<?php
include_once "../main/common.php";
include_once "../main/logweb.php";
include_once "pack.php";


function packSingle($pack,$PACK_ID,$WHERE="1=1"){


    $sql = " SELECT ";


    foreach ( $pack as $key=>$value){

             $sql = $sql." ".$value." AS ".$key.",";
    }



      $sql.=" '' as '' FROM   form004 pack WHERE pack.id in (".$PACK_ID.")  and ".$WHERE." and pack.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res[0];

}

function featSingle($feat,$PACK_ID,$WHERE="1=1"){

    $sql = " SELECT ";


    foreach ( $feat as $key=>$value){

             $sql = $sql." ".$value." AS ".$key.",";
    }



    $sql.=" '' as '' FROM   form013 feat WHERE  feat.dato40 in (".$PACK_ID.") and ".$WHERE." and feat.archived = 'no' ";

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}


function fileSingle($file,$PACK_ID,$WHERE="1=1"){

    $sql = " SELECT ";


    foreach ( $file as $key=>$value){

             $sql = $sql." ".$value." AS ".$key.",";
    }


    $sql.=" '' as '' FROM   form012 file WHERE  file.dato40 in (".$PACK_ID.") and ".$WHERE." and file.archived = 'no' ";

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}


if(($method==='GET')){


    $packId                     = objectID(_pack_,TOKEN_OBJECT,1);
    $database['pack']           = packSingle($PACK,$packId);  
    $database['departureTime']  = featSingle($FEAT,$packId," feat.dato10 in (2) ");
    $database['img']            = fileSingle($FILE,$packId);
    $database['feat']           = featSingle($FEAT,$packId);


    $logwebWhere = "logweb.dato10 = '2' and logweb.dato40 in ('".$packId."') ";  
    $database['logweb']         = master(_logweb_,'logweb','logweb_author,logweb_description,logweb_created','null',$LOGWEB,AGENCY_ID,$logwebWhere);

   echo json_encode($database);

return 0;
exit;
}







/*

    $m = new formModel();
    $m->sql_nativo = "SELECT 
       i.dato07 AS 'file_description', 
       i.token  AS 'token',
       i.token  AS 'file_token',         
       i.dato01 AS 'file_url', 
       i.dato05 AS 'file_name', 
       i.dato06 AS 'file_location', 
       i.dato03  AS 'file_type',
       i.created  AS 'file_created',
       i.archived AS 'file_archived'
FROM   form012 i 
WHERE  i.dato02 = 'package' 
       AND i.dato40 IN  ('".$pack__['id']."') AND i.archived = 'no' ";
    $m->internal = true;
    $database['images'] = $m->all();


function refByAgency($AGENCY__){

        $sql = "SELECT              
        ref.dato01      AS 'ref_fullname',
        ref.dato02      AS 'ref_email',
        ref.dato03      AS 'ref_phone',
        ref.dato10      AS 'ref_status',
        ref.created     AS 'ref_created',
        ref.code        AS 'ref_code',        
        ref.token       AS 'ref_token',        
        ref.dato04       AS 'ref_alias',        
        ref.id          AS 'ref_id'
        FROM   
       form008 ref
       WHERE  ref.dato40 in ('".$AGENCY__."') 
       AND ref.archived = 'no' ";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();      
      return $res;
      
}*/




