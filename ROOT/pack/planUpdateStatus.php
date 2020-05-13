<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";


if(($method==='POST')&&(AGENCY_ID)){


	    UsageAPI('planUpdateStatus',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
	    $planId 	   = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);

	    $plan_status = intval($_POST['plan_status']);

	    if(!$planId) exit;

   if($planId){

				$m = new formModel();
				$m->table   	   = _plan_;
				$m->dato10 		   = $plan_status; 
				$m->dato14 		   = $m->now__(); 
				$m->updated        = $m->now__();
				$m->updated($planId);
				ok();

				if( ($plan_status==1) && ($request[0]=='yes') ){

					$AppPlan          = " app.dato41 in (".$planId.") and app.dato10 in (0) ";
					$database['app']  = master(_app_,'app','app_id','null',$APP,AGENCY_ID,$AppPlan);
				
					foreach ($database['app'] as $value ) {
						appSendConfirmation(AGENCY_ID,$value['app_id']);
					}
					
				}

				if( ($plan_status==1) && ($request[0]=='no') ){



				}


				if( ($plan_status==2) && ($request[0]=='yes') ){

					$AppPlan          = " app.dato41 in (".$planId.") and app.dato10 in (1) ";
					$database['app']  = master(_app_,'app','app_id','null',$APP,AGENCY_ID,$AppPlan);
				
					foreach ($database['app'] as $value ) {
						emailAppClosure(AGENCY_ID,$value['app_id']);
					}

				}


				if( ($plan_status==2) && ($request[0]=='no') ){

				}




                /*

				if($request[0]=='no'){

				}else{
							sendSurvey($planId,$SYSTEM);
				}

				*/
   	
   	}else{
   	
   		echo "error";
   	
   	}		
   	

}


?>