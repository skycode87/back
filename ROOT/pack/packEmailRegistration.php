<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
	
    UsageAPI('packEmailRegistration',AGENCY_ID,AGENT_ID,AGENT_NAME);
	   
    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
		
		if($packId){	        
			$m 			   = new formModel();
		    $m->table      = _pack_;	
			$m->dato35  = str_replace("'","\"", $_POST['pack_email_registration']);	
	    	$m->updated = $m->now__();
			$m->updated($packId);
		}else{
			echo 'error';
			notifySystem('Error packEmailRegistration',1);
		}
}

exit;

?>