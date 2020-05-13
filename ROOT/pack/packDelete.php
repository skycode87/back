<?php
include_once "comun.php";

if(($method==='POST')&&($AGENCY__)){
        UsageAPI('packDelete',$AGENCY__,$USER,$USERNAME__);
        $packId 	   = findIDIntern(_pack_,$TOKEN2__);
		if($packId){
			$database__    = PackByID($packId);
			$m 			   = new formModel();
		    $m->table      = _pack_;	
			$m->archived   = 'yes';	
	    	$m->updated = $m->now__();
			$m->updated($database__['pack_ID']);
		}else{
		 notifySystem('Error packDelete',1);
		}	
 exit;
}


 ?>