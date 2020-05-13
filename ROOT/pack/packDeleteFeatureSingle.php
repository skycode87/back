<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
	
    UsageAPI('packDeleteFeatureSingle',AGENCY_ID,AGENT_ID,AGENT_NAME);

            $featId 	    = objectID(_feat_,TOKEN_OBJECT,AGENCY_ID);


            if(!$featId){ exit; }

            if($featId){
			$m 				= new formModel();
			$m->table  		= _feat_;
			$m->archived	= 'yes';
			$m->updated 	= $m->now__();
    		$m->updated($featId);
			}else{
				 notifySystem('Error packDeleteFeatureSingle',1);
			}
    
    exit;
}

?>