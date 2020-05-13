<?php
include_once "../main/common.php";
include_once "web.php";



if(($method==='POST')&&(AGENCY_ID)){

	
				$m 				= new formModel();
				$m->table  		= _logweb_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->user    	= AGENT_ID;
				$m->code     	= createCode(_logweb_);
				$m->token   	= createToken(_logweb_);
				$m->dato01     	= $request[0];
				$m->dato02     	= $_SESSION['AGENT_NAME'];
				$m->dato03     	= $_SESSION['AGENT_AVATAR'];

				$m->dato41     	= AGENT_ID; 
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato10 	    = 1;
	    		$m->save();

	    		notify($_SESSION['AGENCY_CLUUF']);

     		    updateCluuf($request[0]);


}else{
			//notify('Error en webUpdateCluuf :'.AGENCY_ID);
}



?>


