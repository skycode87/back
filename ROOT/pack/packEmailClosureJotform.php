<?php
include_once "../main/common.php";

$result = $_POST['rawRequest'];
$obj = json_decode($result, true);

$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

if(($method==='POST')&&(AGENCY_ID)){
		   
      
    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
		
		if($packId){	        
			$m 			   = new formModel();
		    $m->table      = _pack_;	
			$m->dato36  = str_replace("'","\"", $obj['q4_body']);	
	    	$m->updated = $m->now__();
			$res = $m->updated($packId);
		}else{
			echo 'error';
			notifySystem('Error packEmailClosure',1);
		}
}

exit;
?>