<?php
include_once "../main/common.php";
//include_once "pack.php";
//include_once "app.php";


if(($method==='POST')&&(AGENCY_ID)){

    // UsageAPI('appUpdate',AGENCY_ID,AGENT_ID,AGENT_NAME);
   
    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);
    $userId     = findRow(_app_,'id',$appId,' dato42 ');


    if( ( $appId ) && ( $userId ) ){

	$m = new formModel();
	$m->table   	   = _user_;
	$m->dato01 		   = ucfirst(strtolower($_POST['user_fullname'])); 
	$m->dato02 		   = $_POST['user_document']; 
	$m->dato04 		   = strtolower($_POST['user_email']); 
	$m->dato05 		   = sg($_POST['user_phone'],15); 
	$m->dato12 		   = $_POST['user_additional_info']; 
	$m->dato06 		   = sg($_POST['user_nationality'],2); 
	$m->dato08 		   = sg($_POST['user_gender'],7); 
	$m->updated        = $m->now__();
	$m->updated($userId);
	
	EventAPP($appId,$_POST['user_fullname']+' '+$_POST['user_document'],'36'); 


			if(($_POST['app08']>0)&&($_POST['app08']<100)&&(setMoney($_POST['app27'])>=0)){
				$m = new formModel();
				$m->table      = _app_;
				$m->dato08 	   = $_POST['app08']; 
				$m->dato26	   = $_POST['app08']*setMoney($_POST['app27']); 
				$m->dato27     = setMoney($_POST['app27']);
				$m->updated    = $m->now__();

			    EventAPP($appId,$_POST['app08']+"/"+$_POST['app27'],'36'); 

				$m->updated($appId);
			}
			

    }else{
    	echo "error en ID";
    }

exit;


}

?>