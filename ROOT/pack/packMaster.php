<?php
include_once "../main/common.php";
include_once "pack.php";


//if(($method==='GET')&&(AGENCY_ID)){

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


function featMaster($select,$pack,$PACK_ID,$WHERE="1=1"){

	  $sql = " SELECT ";
 	  
 	  $ROW = explode(",",$select);
  

		 for($i=0;$i<count($ROW);$i++){

			$sql = $sql." ".$pack[$ROW[$i]]." AS ".$ROW[$i].",";
	
		 }


 	  $sql.=" '' as '' FROM   form013 feat WHERE  feat.dato40 in (".$PACK_ID.") and ".$WHERE." and feat.archived = 'no' ";

      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;

}


   $database['pack'] = packMaster('pack_id,pack_name,pack_type,pack_link,pack_token',$PACK,1);   
  

 if(!$database['pack']['pass']){ 
     for($i=0;$i<count($database['pack']);$i++){
        $database['pack'][$i]['pack_departure_time'] = featMaster(
        	'feat_name,feat_token,feat_id',$FEAT,$database['pack'][$i]['pack_id']," feat.dato10 in (2) ");
      }
 }


    echo json_encode($database); 
    exit;

//}







       /*
   
   if(!$database['package']['pass']){
 
                $m = new formModel();
                $m->select = 'code,dato01,link,dato02,dato03,dato04,dato05,dato06,dato06,dato07,dato08,dato09,dato10,dato11,dato12,dato40,dato42,dato30,dato41,dato25,dato26,dato27,dato28,id,token';
                $m->table = "form001";   
                $m->extra_sql__ = "order by id desc";   
                $m->where__('archived','=','no');
                $m->foreign__('dato40','form003','id',' id,dato01 '); 
                $m->foreign__('dato41','form004','id',' id,dato01 '); 
                $m->foreign__('dato42','form002','id',' id,dato01 ');
                 $m->internal = true;
                $database['tour'] = $m->all();  

    }
   
    */
       
?>