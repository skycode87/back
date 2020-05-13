<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){


    $featId 	   = objectID(_feat_,TOKEN_OBJECT,AGENCY_ID);

    if($featId){ 
	
		$_PUT = $_POST;
		$m = new formModel();
		$m->table      	=  _feat_;
		$m->dato01     	= sg($_POST['dato01'],50); 
	    $m->dato10 	    = intval($_POST['dato10']);
	    $m->user   		= AGENT_ID;
		$m->updated  	= $m->now__();
		$m->updated($featId);
		
	   ok();
	   exit; 

	  }else{
	  	echo "Error de Token Secundario";
	  }
}
