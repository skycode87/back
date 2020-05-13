<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){

	    UsageAPI('webUpdateRoot',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);

     
   	if($webId){

	$m = new formModel();
	$m->table   	   = _web_;
	$m->dato01 		   = $_POST['web_name']; 
	$m->dato02 		   = $_POST['web_value']; 
	$m->dato12 	       = $_POST['web_mode'];
	$m->updated        = $m->now__();
	$m->updated($webId);

   	}else{
		notify('Error en webUpdateRoot :'.AGENCY_ID);
   	}

		
}

?>