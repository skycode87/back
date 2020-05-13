<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){


    UsageAPI('packUpdateStatus',AGENT_ID,AGENT_NAME);

		$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

		if($packId){

			$m 			   = new formModel();
		    $m->table      = _pack_;	
			$m->dato10     = sg($request[0],2);	
	    	$m->updated    = $m->now__();
			$m->updated($packId);

			ok();

		}else{
		 notifySystem('Error packUpdateGmap',1);
		}	
 exit;
}
?>
