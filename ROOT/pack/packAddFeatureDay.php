<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){


        UsageAPI('packAddFeatureDay',AGENCY_ID,AGENT_ID,AGENT_NAME);

		$packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

    if($packId){  

    			foreach ( $_POST['day'] as $day ) {
    				
    			$m 				= new formModel();
				$m->table  		= _feat_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->dato01     	= $day;
			    $m->dato10 	    = '5';
			    $m->dato40 	    = $packId; /* id Package */
	    		$m->code     	= createCode(_feat_);
				$m->token   	= createToken(_feat_);
				$link           = createLink(_feat_);
				$m->dato45 	    = AGENCY_ID; /* id Package */
	    		$m->save();

    			}
			
    	ok();
	}else{
		 notifySystem('Error packAddFeatureDay',1);
	}
    exit;
}

?>