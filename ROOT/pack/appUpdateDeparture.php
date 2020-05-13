<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";


if(AGENCY_ID){

    UsageAPI('appUpdateDeparture',AGENCY_ID,AGENT_ID,AGENT_NAME);
    

    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);


    $_POST['dato10'] = 1;

    $fecha           = $_POST['plan_departure_date'];
    $hora            = $_POST['plan_departure_time'];
    
    $packId      = objectID(_pack_,$_POST['pack_token'],AGENCY_ID);


    if (!$appId ) exit;
    
        
    
        $plan_     = findPlanExist($fecha,$hora,$packId,AGENCY_ID);

                                                                                                        
        if ($plan_['plan_ID'] > 0) {

        
                    $plan__ =  single(_plan_,'plan',$plan_['plan_ID'],'plan_token','null',$PLAN,AGENCY_ID);

                    $m           = new formModel();
                    $m->table    = _app_;
                    $m->dato41   = $plan_['plan_ID'];
                    $m->updated($appId);
                    EventAPP($appId,AGENT_NAME,'39'); 
                    echo $plan__[0]['plan_token'];
                    exit;
                    

        } else {

           
            $pack__ =  single(_pack_,'pack',$packId,'pack_max_limit,pack_min_limit,pack_price','null',$PACK,AGENCY_ID);
            
            $plan['plan_limit_max'] = $pack__[0]['pack_max_limit'];
            $plan['plan_limit_min'] = $pack__[0]['pack_min_limit'];
            $plan['price']          = $pack__[0]['pack_price'];
            $plan['departure_date'] = $_POST['plan_departure_date'];
            $plan['departure_time'] = $_POST['plan_departure_time'];
            $plan['agencyId']       = AGENCY_ID;
            $plan['packId']         = $packId;

            $planId                 = newPlan($plan);

            if($planId){
                    EventAPP($appId,AGENT_NAME,'39'); 
                    $plan__ =  single(_plan_,'plan',$planId,'plan_token','null',$PLAN,AGENCY_ID);
                    echo $plan__[0]['plan_token'];
                    exit;
            }
        }   
}      
exit;
?>
