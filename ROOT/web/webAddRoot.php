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
				$m->dato01     	= trim(strtolower($_POST['web_name'])); /* nombre */
			    $m->dato02 	    = $_POST['web_value'];
			    $m->dato10 	    = $_POST['web_type'];;
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato03 	    = 'ROOT';
			    $m->dato04 	    = $_POST['web_order'];
			    $m->dato10 	    = WEB_TYPE_ROOT;
			    $m->dato40 	    = AGENCY_ID;
	    		$m->save();

   
    	ok();
	}
    exit;


?>