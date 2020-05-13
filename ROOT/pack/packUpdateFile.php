<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
    

 UsageAPI('packUpdateFile',AGENCY_ID,AGENT_ID,AGENT_NAME);

   			$fileId 	   = objectID(_file_,TOKEN_OBJECT,AGENCY_ID);
	
			if($fileId){
				$m = new formModel();
			    $m->table  = _file_;
			    $m->dato07 = $_POST['file_description'];
			    $m->updated($fileId);
			    ok();
			}else{
				 notifySystem('Error packUpdateFile',1);
			}

			exit;
}