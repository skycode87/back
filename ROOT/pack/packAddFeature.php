<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

   
    UsageAPI('packAddFeature',AGENCY_ID,AGENT_ID,AGENT_NAME);
    
	$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

    if($packId){  

	$porciones = explode(",", $_POST['dato01']);
	    
	    for($i=0;$i<count($porciones);$i++){

				$m 				= new formModel();
				$m->table  		= _feat_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->dato01     	= $porciones[$i]; /* nombre */
			    $m->dato10 	    = $_POST['dato10'];
			    $m->dato40 	    = $packId; /* id Package */
			    $m->dato45 	    = AGENCY_ID; /* id Package */
				$m->code     	= createCode(_feat_);
				$m->token   	= createToken(_feat_);
				$link           = createLink(_feat_);
				$m->link   	    = $link;				
				    
	    		$m->save();
	    		ok();
	    }

	}else{
		 notifySystem('Error packAddFeature',1);
	}
    exit;
}

?>