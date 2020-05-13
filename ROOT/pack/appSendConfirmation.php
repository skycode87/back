<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";



if(AGENCY_ID){

    UsageAPI('appSendConfirmation',AGENCY_ID,AGENT_ID,AGENT_NAME);
    
    $appId        = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);

    if (!$appId) exit;

        EventAPP($appId,AGENT_NAME,'12'); 
        $m = new formModel();
        $m->table     = _app_;
        $m->dato21    = $m->now__();
        $m->dato19    = '';
        $m->dato10    = APP_WITHOUT_CONFIRMATION;
        $m->updated($appId);

        appSendConfirmation(AGENCY_ID,$appId); 
}


  
?>