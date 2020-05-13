<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){

      UsageAPI('webDelete',AGENCY_ID,AGENT_ID,AGENT_NAME);
  
    $webId     = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);


    if($webId){
	$m = new formModel();
	$m->table   	   = _web_;
	$m->archived 	   = 'yes'; 
	$m->updated        = $m->now__();
	$m->updated($webId);

   	}else{
          notify('Error en webDelete Agency:'.AGENCY_ID);
   	}		


}


?>