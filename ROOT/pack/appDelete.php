<?php
include_once "../main/common.php";
include_once "app.php";


if(($method==='POST')&&(AGENCY_ID)){

    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);

    UsageAPI('appDelete',AGENCY_ID,AGENT_ID,AGENT_NAME);

		if($appId){

            $app__ =  single(_app_,'app',$appId,'app_type,app_userId,app_planId','null',$APP,AGENCY_ID);

			if($app__[0]['app_type']!='invited'){
			
				 $m = new formModel();
			     $m->table  = _app_ ;
			     $m->where__('dato40','=',$appId);
			     $m->where__('dato09','=','invited');
			     $m->internal = true;
			     $res = $m->all();

			    foreach ($res as $key ){

			 		$m 			   = new formModel();
					$m->table      = _app_;	
		    		$m->archived   = "yes";		
			    	$m->updated    = $m->now__();
					$m->updated($key['id']);
			    }

    		
    			$m 			   = new formModel();
				$m->table      = _app_;
			    $m->archived   = "yes";		
				$m->updated    = $m->now__();		
				$m->updated($appId);

                $m              = new formModel();
                $m->table 	    = _user_;
                $m->archived    = 'yes';
                $m->updated($app__[0]['app_userId']);


    		}else{

				$m 			   = new formModel();
				$m->table      = _app_;
			    $m->archived   = "yes";		
				$m->updated    = $m->now__();		
				$m->updated($appId);
				EventAPP($appId,AGENT_NAME,'32'); 
    		}

    		archivarPlan($app__[0]['app_planId']);

 
   }else{
   	echo "Token Invalido";
   }

}



?>