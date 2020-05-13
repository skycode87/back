<?php
include_once "../main/common.php";
include_once "agent.php";



if(($method==='POST')&&(AGENCY_ID)){

	$agentId 	   = objectID(_agent_,TOKEN_OBJECT,AGENCY_ID);


   	if($agentId){


   		$single     = single(_agent_,'agent',$agentId,'null','null',$AGENT,AGENCY_ID);
		$m 			= new formModel();

		notify($single[0]['agent_username']);
		notify($single[0]['agent_password']);

   	    notify($m->md7__($_POST['agent_password']));
   			

   		if($single[0]['agent_password'] == $m->md7__($_POST['agent_password'])){


			if($_POST['agent_password01']==$_POST['agent_password02']){

				$m = new formModel();
				$m->table   	   = _agent_;
				$m->dato05         = $m->md7__($_POST['agent_password01']); 
				$m->updated        = $m->now__();	
				

				if(($m->updated($agentId))==1){
					echo 'ok';
				}
				

			}else{
				echo 'New Password is invalid';
			}


   		}else{
   			echo 'Current Password is invalid';
      	}

   	}else{
		notify('Error en agentUpdate :'.AGENCY_ID);
   	}

}



?>


