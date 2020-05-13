<?php
include_once "../main/common.php";
include_once "../main/pack.php";





if(($method==='POST')&&(AGENCY_ID)){


	    UsageAPI('packUpdate',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
	    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);


		if($packId){

			$m 			    = new formModel();
			$m->table       = _pack_;	
			$m->dato01  	= sg($_POST['pack_name'],50);	
			$m->dato03      = sg($_POST['pack_duration'],50);	
			$m->dato06      = sg($_POST['pack_max_limit'],5);	
			$m->dato07      = sg($_POST['pack_min_limit'],5);	
			$m->dato08  	= sg(setMoney($_POST['pack_price']),50);	
			$m->dato13  	= $_POST['pack_departure_location'];	
			$m->dato10  	= sg($_POST['pack_status'],1);				
			$m->dato02  	= sg(trim(strtoupper($_POST['pack_tag'])),50);							
			$m->dato32  	= sg(trim(strtoupper($_POST['pack_category'])),50);	
			$m->dato15  	= trim(strtoupper($_POST['pack_phone']));	
			$m->dato05  	= sg($_POST['pack_contact'],20);	
			$m->dato14  	= trim(str_replace(" ", "-", strtolower($_POST['pack_url'])));	
	    	$m->updated 	= $m->now__();    	  	
			$m->updated($packId);


		}else{
		 notify('Error en packUpdate Agency:'.AGENCY_ID);
		}

 exit;
}

?>
