<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";

function planMaster($select,$rows,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";

    if($select!='null'){
     	   $ROW = explode(",",$select);
    		 for($i=0;$i<count($ROW);$i++){
    			$sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
    		 }

    }else{
        foreach ( $rows as $key=>$value){
                 $sql = $sql." ".$value." AS ".$key.",";
        }
    }



 	  $sql.=" '' as '' FROM   form001 plan WHERE   and ".$WHERE." and plan.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}

function planSingle($plan,$PLAN_ID,$AGENCY_ID,$WHERE="1=1"){

      $sql = " SELECT ";


      foreach ( $plan as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }    


      $sql.=" '' as '' FROM   form001 plan WHERE plan.id in (".$PLAN_ID.")  and ".$WHERE." and plan.archived = 'no' and plan.dato45 in (".$AGENCY_ID.") ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res[0];
}

function appMaster($select,$noselect,$rows,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";

 
    if($select!='null'){
         $ROW = explode(",",$select);
          for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
           }

    } 


    if($select=='null'){

         if($noselect=='null'){

          foreach ( $rows as $key=>$value){

                   $sql = $sql." ".$value." AS ".$key.",";
          }

          
        }else{


               $selectFinal = suprimirSelects($noselect,$rows);
               $ROW = explode(",",$selectFinal);
               for($i=0;$i<count($ROW);$i++){
                $sql = $sql." ".$rows[$ROW[$i]]." AS ".$ROW[$i].",";
               }

        }
    }


    


      $sql.=" '' as '' FROM   form005 app WHERE app.dato45 in (".$AGENCY_ID.")  and ".$WHERE." and app.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}

function transMaster($select,$trans,$AGENCY_ID,$WHERE="1=1"){

    $sql = " SELECT ";
    
    $ROW = explode(",",$select);
  

     for($i=0;$i<count($ROW);$i++){

      $sql = $sql." ".$trans[$ROW[$i]]." AS ".$ROW[$i].",";
     
     }



    $sql.=" '' as '' FROM   form009 trans WHERE trans.dato45 in (".$AGENCY_ID.")  and ".$WHERE." and trans.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}

function userSingle($user,$USER_ID,$WHERE="1=1"){


    $sql = " SELECT ";


    foreach ( $user as $key=>$value){

             $sql = $sql." ".$value." AS ".$key.",";
    }



    echo  $sql.=" '' as '' FROM   form006 user WHERE user.id in (".$USER_ID.")  and ".$WHERE." and user.archived = 'no' ";
      $m             = new formModel();
      $m->sql_nativo = $sql;
      $m->internal   = true;
      $res           = $m->all();
      return $res;
}




//$planId      = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);
 
$planId      =  '555'; 
 
$database['plan'] = planSingle($PLAN,$planId,1);

$packId           = $database['plan']['plan_packId'];
$packSingle       = single(_pack_,'pack',$packId,'pack_name,pack_token,pack_duration','null',$PACK,1);
$database['plan'] = array_merge($database['plan'],$packSingle[0]); 



$RefGuideSingle       = single(_ref_,'ref',$database['plan']['plan_refererId'],'null','ref_code,ref_id,ref_avatar,ref_observation,ref_link',$REFERER,1);
$database['refPlan']  = $RefGuideSingle[0];


$FeatPack          = "feat.dato40 in (".$packId.") and feat.dato10 in (2) ";
$database['departureTime']  = master(_feat_,'feat','feat_name,feat_id,feat_token','null',$FEAT,1,$FeatPack);


$planId           = $database['plan']['plan_id'];
$noSelect         = '';
$AppPlan          = "app.dato41 in (".$planId.")";
$database['apps'] = master(_app_,'app','null','null',$APP,1,$AppPlan);



 for($i=0;$i<count($database['apps']);$i++){

    $packsId.=    $database['apps'][$i]['app_id'].",";
   

    $userId     = $database['apps'][$i]['app_userId'];
    $userSingle = single(_user_,'user',$userId,'null','null',$USR,1);


    if(!$userSingle[0]) $userSingle[0]['user_id'] = null;
    $database['apps'][$i] = array_merge( $database['apps'][$i] , $userSingle[0]   ); 


    $refId     = $database['apps'][$i]['app_refId'];
    $refSingle = single(_ref_,'ref',$refId,'null','null',$REFERER,1);

    if(!$refSingle[0]) $refSingle[0]['ref_id'] = null;
    
    $database['apps'][$i] = array_merge($database['apps'][$i],$refSingle[0]); 
    $database['apps'][$i]['ref_status_name'] =  ref_status_name($database['apps'][$i]['ref_status']);




    $TransApp          = "trans.dato40 in (".$database['apps'][$i]['app_id'].")";
    $database['apps'][$i]['trans'] = master(_trans_,'trans','trans_mode,trans_paid,trans_pending','null',$TRANS,1,$TransApp);



 }



$RefAgen  = " ref.dato45 in (1) ";
$database['ref']  = master(_ref_,'ref','null','null',$REFERER,1,$RefAgen);


$TransPlan                  = "trans.dato40 in (".substr($packsId,0,-1).") ";
$database['trans']  = master(_trans_,'trans','null','null',$TRANS,1,$TransPlan);

      $m = new formModel();
      $m->sql_nativo = "SELECT sum(dato08) as 'total_clientes' , sum(dato26) as 'total_total', sum(dato25) as 'total_pago' , (sum(dato26)-sum(dato25)) as  'total_apagar'  FROM form005 where dato41 in (".$planId.") and dato09 <> 'invited' and archived='no' ";
       $m->internal = true;
       $totales = $m->all();
       $database['totales'] =  $totales[0];
  

$sql =  "update form005 set dato12='".date('Y-m-d')."' where dato41 in (".$ID_MASTER.") and archived='no' ";
$m->execute_sql($sql);

 echo json_encode($database); 

       
?>