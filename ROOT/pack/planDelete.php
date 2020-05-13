<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";


if(($method==='POST')&&(AGENCY_ID)){

	
	    $planId 	   = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);


	    if(!$planId) exit;

 
 	    if($planId){

					$m = new formModel();
					$m->table   	   = _plan_;
					$m->archived 	   = 'yes'; 
					$m->updated        = $m->now__();
					$m->updated($planId);
					ok();
	   	
	   	}else{
	   	
	   		echo "error";
	   	
	   	}		

}


?>