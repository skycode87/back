<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
	
    UsageAPI('packUpdateSummary',AGENCY_ID,AGENT_ID,AGENT_NAME);
	   
    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
		
		if($packId){	        
			$m 			   = new formModel();
		    $m->table      = _pack_;	
		    $m->dato37  = str_replace("'","\"", $_POST['pack_summary']);
	    	$m->updated = $m->now__();
			$m->updated($packId);
		}else{
			echo 'error';
			notifySystem('Error packUpdateSummary',1);
		}
}

exit;
?>