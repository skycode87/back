<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
	
    UsageAPI('packEmailConfirmation',AGENCY_ID,AGENT_ID,AGENT_NAME);
	   
    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
		
		if($packId){	        
			$m 			   = new formModel();
		    $m->table      = _pack_;	
			$m->dato33  = str_replace("'","\"", $_POST['pack_email_confirmation']);	
	    	$m->updated = $m->now__();
			$m->updated($packId);
		}else{
			echo 'error';
			notifySystem('Error pack_email_confirmation',1);
		}
}

exit;
?>