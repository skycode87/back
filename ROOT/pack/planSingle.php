<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";



/*

https://backend.ibusuites.com/ROOT/pack/planSingle.php/
UGFHQJXPAE8CINKDVJTW09S1SA4XUPO2RMLZYKEF3RVHLWCYMQCKGPNDINEAUWCX8BVKJTFFXUASOH1MTZD3ZL2Q9PLBVYIGW6RQ
lsd'
undefined
lsd
ADMIN
lsd
HYRVXBD5AWF2TMJ1EEL4NI0ZWT87MLUDI9SUGGCVKPBSZQ6POCYDAUJHXOUDYPC9WQWA5ZF0NZBM42L6TNFKSSIPERXGVV8LKGEB
lsd
HYRVXBD5AWF2TMJ1EEL4NI0ZWT87MLUDI9SUGGCVKPBSZQ6POCYDAUJHXOUDYPC9WQWA5ZF0NZBM42L6TNFKSSIPERXGVV8LKGEB


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

*/



// exit;       


$planId      = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);

// VALIDA SI EL PLAN TIENE APLICACIONES ACTIVAS, SINO TIENE APLICACIONES LO ELIMINA Y NO CONTINUA EN EL PROCESO
$sql = "select count(plan.id) as 'total', plan.id  as 'id' from form001 plan join form005 app on app.dato41 = plan.id and app.archived='no' and plan.archived= 'no' and plan.id in (".$planId.") group by plan.id order by 1 desc ";

            $m             = new formModel();
            $m->sql_nativo = $sql;
            $m->internal   = true;
            $res1          = $m->all();

            if(!$res1[0]['id']){
                $m              = new formModel();
                $m->table     = 'form001';
                $m->archived    = 'yes';
                $m->updated(intval($plan_id));
                echo 'null';
                exit;
            } 


//$database['plan'] = planSingle($PLAN,$planId,1);
//$packSingle       = single(_pack_,'pack',$packId,'pack_name,pack_token,pack_duration','null',$PACK,1);
//$database['plan']  = array_merge($database['plan'],$packSingle[0]); 


$database['plan'] =  single(_plan_,'plan',$planId,'null','null',$PLAN,AGENCY_ID);
$packId           = $database['plan'][0]['plan_packId'];
$packSingle       =  single(_pack_,'pack',$packId,'pack_name,pack_token,pack_duration','null',$PACK,AGENCY_ID);

$database['plan'] = array_merge($database['plan'][0],$packSingle[0]); 




$RefGuideSingle             = single(_ref_,'ref',$database['plan']['plan_refererId'],'null','ref_code,ref_id,ref_avatar,ref_observation,ref_link',$REFERER,1);
$database['refPlan']        = $RefGuideSingle[0];


$FeatPack                   = "feat.dato40 in (".$packId.") and feat.dato10 in (2) ";
$database['departureTime']  = master(_feat_,'feat','feat_name,feat_id,feat_token','null',$FEAT,1,$FeatPack);





$planId           = $database['plan']['plan_id'];

$noSelect         = '';

$AppPlan          = "app.dato41 in (".$planId.")";

$database['apps'] = master(_app_,'app','null','null',$APP,1,$AppPlan);

$database['apps'] = appData($planId,'app','plan','*');

 for($i=0;$i<count($database['apps']);$i++){
    $packsId.=    $database['apps'][$i]['app_id'].",";
    $TransApp          = "trans.dato40 in (".$database['apps'][$i]['app_id'].")";
    $database['apps'][$i]['trans'] = master(_trans_,'trans','trans_mode,trans_paid,trans_pending','null',$TRANS,1,$TransApp);
 }


/*
$RefAgen  = " ref.dato45 in (1) ";
$database['ref']  = master(_ref_,'ref','null','null',$REFERER,1,$RefAgen);
*/

$TransPlan                  = "trans.dato40 in (".substr($packsId,0,-1).") ";
$database['trans']          = master(_trans_,'trans','null','null',$TRANS,1,$TransPlan);

      $m = new formModel();
      $m->sql_nativo = "SELECT sum(dato08) as 'total_clientes' , sum(dato26) as 'total_total', sum(dato25) as 'total_pago' , (sum(dato26)-sum(dato25)) as  'total_apagar'  FROM form005 where dato41 in (".$planId.") and dato09 <> 'invited' and archived='no' ";
       $m->internal = true;
       $totales = $m->all();
       $database['totales'] =  $totales[0];
  


// Notificacion de que este Tour ha sido visualizado
$sql =  "update form005 set dato12='".date('Y-m-d')."' where dato41 in (".$planId.") and archived='no' ";
$m->execute_sql($sql);


// Guarda todo el json para acelerar consultas, para consultas cuando el plan esta cerrado o habra que ingeniarse algo.
$file       = "../data/".AGENCY_TOKEN.TOKEN_OBJECT.".json";
file_put_contents($file,json_encode($database));


echo json_encode($database); 

       
?>