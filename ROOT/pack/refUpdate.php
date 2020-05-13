<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

	UsageAPI('refUpdate',AGENCY_ID,AGENT_ID,AGENT_NAME);

    $refId      = objectID(_ref_,TOKEN_OBJECT,AGENCY_ID);

     
   	if($refId){

				$m = new formModel();
				$m->table   	   = _ref_;
				$m->dato01     	= ucfirst(strtolower($_POST['ref_fullname'])); 
			    $m->dato02 	    = strtolower($_POST['ref_email']);
			    $m->dato03 	    = $_POST['ref_phone'];
			    $m->dato04 	    = strtolower($_POST['ref_alias']);
			    $m->dato08 	    = $_POST['ref_address'];
			    $m->dato31 	    = $_POST['ref_observation'];
			    $m->dato05 	    = $_POST['ref_document'];
			    $m->dato06 	    = $_POST['ref_document_type']; 
				$m->updated        = $m->now__();
				$m->updated($refId);

   	}else{
   		notify('Error refupdate ');
   	}

		
}

?>