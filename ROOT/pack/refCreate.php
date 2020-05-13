<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

	UsageAPI('refCreate',AGENCY_ID,AGENT_ID,AGENT_NAME);

    if(AGENCY_ID){  

				$m 				= new formModel();
				$m->table  		= _ref_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				
				$m->code     	   = createCode(_ref_);
				$m->token   	   = createToken(_ref_);
				$m->link   	       = createLink(_ref_);

				$m->dato01     	= ucfirst(strtolower($_POST['ref_fullname'])); 
			    $m->dato02 	    = strtolower($_POST['ref_email']);
			    $m->dato45 	    = '1';
			    $m->dato03 	    = $_POST['ref_phone'];
			    $m->dato04 	    = strtolower($_POST['ref_alias']);
			    $m->dato08 	    = $_POST['ref_address'];
			    $m->dato31 	    = $_POST['ref_observation'];
			    $m->dato05 	    = $_POST['ref_document'];
			    $m->dato06 	    = $_POST['ref_document_type'];
			    $m->dato10 	    = 1;
			    $m->dato40 	    = AGENCY_ID; 
			    $m->dato45 	    = AGENCY_ID; 
	    		$m->save();

    	ok();
	}
    exit;
}

?>