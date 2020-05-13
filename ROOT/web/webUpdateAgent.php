<?php
include_once "../main/common.php";
include_once "agent.php";



if(($method==='POST')&&(AGENCY_ID)){

	$agentId 	   = objectID(_agent_,TOKEN_OBJECT,AGENCY_ID);

   	if($agentId){



		
		$m = new formModel();
		$m->table   	= _agent_;
		$m->dato01      = trim(strtolower($_POST['agent_fullname'])); 
		$m->dato03     	= trim(strtolower($_POST['agent_phone'])); 
		$m->dato06     	=  trim(strtolower($_POST['agent_email']));  
		$m->dato31 	    = $_POST['agent_icon'];
	    $m->dato32 	    = $_POST['agent_description_quill'];
		$m->updated        = $m->now__();	
		$m->updated($agentId);


   	}else{
		notify('Error en agentUpdate :'.AGENCY_ID);
   	}

}

?>


