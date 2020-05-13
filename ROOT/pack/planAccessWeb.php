<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";
include_once "agent.php";
include_once "agency.php";


    $packId          = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
   

    if (!$packId) exit;


     $ref_alias       = $_POST['user01'];






    $agentDatabase = singleNoId(_agent_,'agent','null','agent_password,agent_alias',$AGENT,AGENCY_ID," dato04 in ('".$ref_alias."') and dato10 in (1) ");
   
    $packDatabase = single(_pack_,'pack',$packId,'pack_name','null',$PACK,AGENCY_ID);

    $agencyDatabase  = single(_agency_,'agency',AGENCY_ID,'agency_token,agency_name,agency_logo','null',$AGENCY,AGENCY_ID);


    if(!isset($_POST['plan02'])){

        $agentDatabase = singleNoId(_agent_,'agent','null','agent_password,agent_alias',$AGENT,AGENCY_ID," dato04 in ('".$request[1]."') and dato10 in (1) ");
   

                $data['agent']  = $agentDatabase[0];
              $data['agency'] = $agencyDatabase[0];
              $data['pack']   = $packDatabase[0];
              echo json_encode($data);
              exit;   


    }else{


            $_POST['dato10'] = 1;
            $fecha           = $_POST['plan02'];
            $hora            = $_POST['plan04'];    
            $ref_alias       = $_POST['user01'];


    }
    
    $agentDatabase = singleNoId(_agent_,'agent','null','agent_password,agent_alias',$AGENT,AGENCY_ID," dato04 in ('".$ref_alias."') and dato10 in (1) ");
   

    $wherePlan = "plan.dato01 in ('".$fecha."') and plan.dato03 in ('".ltrim($hora)."') and plan.dato40 in ('".AGENCY_ID."') and plan.dato41 in ('".$packId."') and plan.archived='no' ";
        
    $planDatabase = singleNoId(_plan_,'plan','plan_id,plan_link','null',$PLAN,AGENCY_ID,$wherePlan);


    if ( $planDatabase[0]['plan_id'] > 0) {
              $data['agent']  = $agentDatabase[0];
              $data['agency'] = $agencyDatabase[0];
              $data['pack']   = $packDatabase[0];
              $data['plan']   = $planDatabase[0];
              echo json_encode($data);
              exit;   
    }else{
        echo 'error';
    }



?>