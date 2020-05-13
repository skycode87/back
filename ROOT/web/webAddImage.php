<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){


				$m 				= new formModel();
				$m->table  		= _web_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->user    	= AGENT_ID;
				$m->code     	= createCode(_web_);
				$m->token   	= createToken(_web_);
				$m->link   	    = createLink(_web_);		
				$m->dato01     	= $m->now__();
			    $m->dato02 	    = $_POST['web_value'];
			    $m->dato05 	    = $m->now__();
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato03 	    = $_POST['web_category'];
			    $m->dato10 	    = WEB_TYPE_IMAGE;
			    $m->dato40 	    = AGENCY_ID;
	    		$m->save();

   
    	ok();
	}
    exit;


?>