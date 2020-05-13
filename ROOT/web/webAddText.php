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
			    $m->dato02 	    = str_replace("'","\"",$_POST['web_content_html']);
			    $m->dato05 	    = $_POST['web_description'];
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato03 	    = addCategory(AGENCY_ID,$_POST['web_root']);
			    $m->dato04 	    = $_POST['web_order'];
			    $m->dato41 	    = $_POST['web_root'];
			    $m->dato10 	    = WEB_TYPE_HTML;
			    $m->dato40 	    = AGENCY_ID;
	    		$m->save();

   
    	ok();
	}
    exit;


?>