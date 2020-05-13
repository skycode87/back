 <?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
    UsageAPI('packDeleteImage',AGENCY_ID,AGENT_ID,AGENT_NAME);
    $fileId 	   = objectID(_file_,TOKEN_OBJECT,AGENCY_ID);
		if($fileId){
			$m 			   = new formModel();
		    $m->table      = _file_;	
			$m->archived   = 'yes';	
	    	$m->updated = $m->now__();
			$m->updated($fileId);
			ok();
		}	
 		exit;
}


?>
