<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";

if(AGENCY_ID){

        UsageAPI('appUpdateStatusLocal',AGENCY_ID,AGENT_ID,AGENT_NAME);

        $appId        = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);

		if (!$appId) exit;

        EventAPP($appId,AGENT_NAME,'12'); 

		$m 			   = new formModel();
		$m->table      = _app_;	
		$m->dato10 	   = intval($_POST['app_status']); 	
		$m->dato01 	   = intval($_POST['app_status']); 	
    	$m->updated    = $m->now__();
		$m->updated($appId);

}else{

echo "error";

}




?>
