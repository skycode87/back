<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){


        UsageAPI('packAddFeatureTime',AGENCY_ID,AGENT_ID,AGENT_NAME);

		$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

    if($packId){  

				$m 				= new formModel();
				$m->table  		= _feat_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->dato01     	= $_POST['hour'].":".$_POST['minutes']." ".$_POST['temp']; 
			    $m->dato10 	    = '2';	    		
			    $m->code     	= createCode(_feat_);
				$m->token   	= createToken(_feat_);
				$link           = createLink(_feat_);
			    $m->dato40 	    = $packId; /* id Package */
			    $m->dato45 	    = AGENCY_ID; /* id Package */
	    		$m->save();
    	ok();
	}else{
		 notifySystem('Error packAddFeatureTime',1);
	}	

    exit;
}

?>

