<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){

	    UsageAPI('webUpdateImage',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);



   	if($webId){
		$m = new formModel();
		$m->table   	   = _web_;
		$m->dato02 		   = str_replace("'","\"",$_POST['web_value']);	
		$m->updated        = $m->now__();
		$m->updated($webId);

   	}else{
		notify('Error en webUpdateImage :'.AGENCY_ID);
   	}

		
}

?>