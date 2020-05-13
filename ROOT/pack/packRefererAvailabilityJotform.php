<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";


    $m              = new formModel();
    $m->sql_nativo  = "select token from form004  where code in ('".TOKEN_OBJECT."')";
    $m->internal    = true;
    $res            = $m->all();

    $packId        = objectID(_pack_,$res[0]['token'],AGENCY_ID);



    $fecha = $_POST['q4_departureDate']['year']."-".$_POST['q4_departureDate']['month']."-".$_POST['q4_departureDate']['day'];
    $hora  = $_POST['q5_departureTime'];
   
    if (!$packId) exit;


    $plan_ = findPlanExist($fecha, $hora, $packId,AGENCY_ID);


    if($plan_['plan_ID']){


        $data['total']              = listApps(AGENCY_ID,$plan_['plan_ID']);
        $DATABASE                   = limitesPlan(AGENCY_ID,$plan_['plan_ID']);
        $data['pack_max_limit']     = $DATABASE['plan_max_limit'];
        $data['pack_min_limit']     = $DATABASE['plan_min_limit'];
        echo json_encode($data);
        exit;    
      

    }else{

        $data['total']              = 0;
        $DATABASE                   = limitesPack(AGENCY_ID,$packId);
        $data['pack_max_limit']     = $DATABASE['pack_max_limit'];
        $data['pack_min_limit']     = $DATABASE['pack_min_limit'];
        echo json_encode($data);
        exit;          

    }

    
    exit;




function listApps($agencyId,$planId){
        $m               = new formModel();
        $m->sql_nativo   = "SELECT * from form005 where dato41 in ('".$planId."') and dato45 in ('".$agencyId."') and archived = 'no' and ( dato10='1' or dato10='0' )  ";
        $m->internal     = true;  
        $apps            =  $m->all();
       
        if(isset($apps['pass'])){
            return 0;
        }else{
            return count($apps);
        }

        
}

function limitesPlan($agencyId,$planId){
        $m               = new formModel();
        $m->sql_nativo   = "SELECT dato06 as 'plan_max_limit', dato07 as 'plan_min_limit', dato10 as plan_status from form001 where id in ('".$planId."') and dato45 in ('".$agencyId."') and archived = 'no'  limit 1 ";
        $m->internal     = true;  
        $apps            =  $m->all();
        return $apps[0];
}


function limitesPack($agencyId,$packId){
        $m               = new formModel();
        $m->sql_nativo   = "SELECT dato06 as 'pack_max_limit', dato07 as 'pack_min_limit' from form004 where id in ('".$packId."') and dato45 in ('".$agencyId."') and archived = 'no'  limit 1 ";
        $m->internal     = true;  
        $apps            =  $m->all();
        return $apps[0];
}

?>