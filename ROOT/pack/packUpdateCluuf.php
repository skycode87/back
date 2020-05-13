<?php
include_once "../main/common.php";
include_once "../main/pack.php";
include_once "pack.php";
include_once "app.php";

	

if(($method==='POST')&&(AGENCY_ID)){


				$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);


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
				$m->dato04     	= 'Update Pack';

				$m->dato40     	= $packId; 
				$m->dato41     	= AGENT_ID; 
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato10 	    = 2; 
	 
	    		$m->save();

				
				$pack__ =  single(_pack_,'pack',$packId,'pack_url','null',$PACK,AGENCY_ID);

     		    updateCluufPack($request[0],$pack__[0]['pack_url']);


}else{
			notify('Error en packUpdateCluuf :'.AGENCY_ID);
}



?>
