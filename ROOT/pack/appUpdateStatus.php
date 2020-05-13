<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";


if(AGENCY_ID){

        UsageAPI('appUpdateStatus',AGENCY_ID,AGENT_ID,AGENT_NAME);
    
        $appId        = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);

		if (!$appId) exit;

        EventAPP($appId,AGENT_NAME,'12'); 

		$variables_email = varialesGlobalesEmails(AGENCY_ID);

        if($request[0]==1){
        	EventAPP($appId,$APP_STATUS[intval($request[0])],'37'); 
			$msj = $variables_email['msg_confirmation_application_by_email_link'];
        } 

        if($request[0]==2){
			EventAPP($appId,$APP_STATUS[intval($request[0])],'38'); 
			$msj = $variables_email['msg_cancelation_application_by_email_link'];

        } 

		$m 			   = new formModel();
		$m->table      = _app_;	
		$m->dato10 	   = intval($request[0]); 	
		$m->dato01 	   = intval($request[0]); 	
    	$m->updated    = $m->now__();
		$m->updated($appId);

	    echo messagePublic(AGENCY_ID,$msj);


    
}else{

echo "error";

}




?>
