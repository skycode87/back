<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){

	    UsageAPI('webUpdateHTML',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);

     
   	if($webId){

	$m = new formModel();
	$m->table   	   = _web_;
	$m->dato01 		   = $_POST['web_name']; 
	$m->dato02 		   = str_replace("'","\"",$_POST['web_update_html']);	
	$m->dato03 	       = addCategory(AGENCY_ID,$_POST['web_root']);
	$m->dato04 		   = $_POST['web_order']; 
	$m->dato05 		   = $_POST['web_description']; 
	$m->dato10 		   = $_POST['web_type']; 
	$m->dato41 		   = $_POST['web_root']; 
	$m->updated        = $m->now__();
	$m->updated($webId);

   	}else{
		notify('Error en webUpdateHTML :'.AGENCY_ID);
   	}

		
}

?>