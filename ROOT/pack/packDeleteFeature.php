<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){


    UsageAPI('packDeleteFeature',AGENCY_ID,AGENT_ID,AGENT_NAME);

    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);

    if($packId){

            for($i=0;$i<count($_POST['featureIds']);$i++){

        			$m 				= new formModel();
        			$m->table  		= _feat_;
        			$m->archived	= 'yes';
        			$m->updated 	= $m->now__();
            		$m->updated($_POST['featureIds'][$i]);
            };

    }else{
         notifySystem('packDeleteFeature',1);
    }   
    
}

?>