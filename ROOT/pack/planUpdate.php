<?php
include_once "../main/common.php";


echo $_POST['plan_cost'];

echo "<br>";

echo sg(setMoney($_POST['plan_cost']),50);	


exit;


if(($method==='POST')&&(AGENCY_ID)){



	    UsageAPI('planUpdate',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
	    $planId 	   = objectID(_plan_,TOKEN_OBJECT,AGENCY_ID);
	  

	    $refererId 	   = objectID(_ref_,$_POST['plan_refererId'],AGENCY_ID);




		if($planId){


			$m 			    = new formModel();
			$m->table       = _plan_;	
			$m->dato01  	= sg($_POST['plan_departure_date'],20);	
			$m->dato03      = sg($_POST['plan_departure_time'],50);	
			$m->dato06      = sg($_POST['plan_max_limit'],5);	
			$m->dato07      = sg($_POST['plan_min_limit'],5);	
			$m->dato08  	= sg(setMoney($_POST['plan_cost']),50);	
			$m->dato10  	= intval(($_POST['plan_status']));	
			$m->dato31  	= $_POST['plan_observation'];		
			$m->dato43  	= $refererId;		
	    	$m->updated 	= $m->now__();    	  	
			$m->updated($planId);


   

			/*
			$cURLConnection = curl_init();
			curl_setopt($cURLConnection, CURLOPT_URL, 'https://backend.ibusuites.com/'.);
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
			curl_exec($cURLConnection);
			curl_close($cURLConnection);
			*/
		
		}else{
		 notify('Error en planUpdate Agency:'.AGENCY_ID);
		}

 exit;
}

?>
