<?php
include_once "../main/common.php";
//include_once "pack.php";
//include_once "app.php";


if(($method==='POST')&&(AGENCY_ID)){


        UsageAPI('appCreate',AGENCY_ID,AGENT_ID,AGENT_NAME);


        $planId      = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);



   	if(!$planId) exit;

  


	$m 				   = new formModel();
	$m->table   	   = _user_;
	$m->dato01 		   =  ucfirst(strtolower($_POST['user_fullname']));
	$m->dato02 		   = $_POST['user_document']; 
	$m->dato04 		   = strtolower($_POST['user_email']); 
	$m->dato05 		   = $_POST['user_phone']; 
	$m->dato12 		   = strtolower($_POST['user_additional_info']);
	$m->dato45 		   = AGENCY_ID;
	$m->dato42 		   = AGENCY_ID;
	$m->dato09 		   = 'main'; 
	
	$m->updated 	   = $m->now__();
	$m->created        = $m->now__();

	$m->code     	   = createCode(_user_);
	$m->token   	   = createToken(_user_);
	$m->link   	       = createLink(_user_);

	$m->user           = AGENT_ID;
	$m->archived 	   = "no"; 	
	$userId 		   =  $m->save();
		
		

		$m 			   = new formModel();
		$m->table      = _app_;
		$m->dato08 	   = $_POST['app08']; 
		$m->dato10 	   = 0; 	
		$m->dato01 	   = 0; 			
		$m->dato09 	   = 'local'; 				
		$m->dato26	   = $_POST['app08']*setMoney($_POST['app27']); 
		$m->dato27     = setMoney($_POST['app27']);
		$m->dato16	   = 0;
		$m->dato41	   = $planId;
		$m->dato18	   = AGENT_NAME;	
		$m->dato43	   = $userId;	
		$m->dato42 	   = $userId;						
		$m->updated    = $m->now__();
		$m->code       = createCode(_app_);
		$m->token      = createToken(_app_);
	    $m->link   	   = createLink(_app_);				
		$m->created    = $m->now__();
		$m->user 	   = AGENT_ID;
		$m->dato45	   = AGENCY_ID;
		$m->dato25	   = 0;				
		$m->archived   = "no"; 			
		$appId 		   = $m->save();

		EventAPP($appId,AGENT_NAME,'2'); 

   	

}

?>