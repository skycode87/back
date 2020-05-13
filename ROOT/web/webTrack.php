<?php
include_once "../main/common.php";
include_once "../main/track.php";
include_once "web.php";


	if($_POST['code']==''){
		exit;
	}


	if(($method==='POST')&&(AGENCY_ID)){



				$porciones = explode("/",$_SERVER['HTTP_REFERER']);
				$path    = '/';
				$cta 	 = '';
				$userId  = AGENT_ID;

				if($_POST['type']=='form'){
					$type = 2;
				}

				if($_POST['type']=='page'){
					$type = 1;
				}

				if($_POST['type']=='cta'){
				  $cta = $_POST['cta'];
				  $type = 3;
				  $view = null;

				}

				foreach ($porciones as &$valor) {	
					$path = $valor;
				}

				if ($path == '') $path = '/';



				if($porciones['3']=='referer'){
   					   
   					   $pack_code = $porciones['4'];
   					   $ref_code  = $porciones['5'];


   					   $m             = new formModel();
        			   $m->sql_nativo = " SELECT id,dato01 FROM "._pack_."  WHERE code in ('".$pack_code."') and dato45 in ('".AGENCY_ID."') ";
        			   $m->internal   = true;
        			   $resPack           = $m->all();


   					   $m             = new formModel();
        			   $m->sql_nativo = " SELECT id,dato01 FROM "._ref_."  WHERE code in ('".$ref_code."') and dato45 in ('".AGENCY_ID."') ";
        			   $m->internal   = true;
        			   $resRef           = $m->all();



        			   $path   =  $resPack[0]['dato01'];  
					   $userId =  $resRef[0]['id'];
					   $cta    =  $resRef[0]['dato01'];
				}




				if($_POST['code']=='doe'){
					$code = createCode(_track_);
					$view = 1;
				}else{


						if($view==null){

					   $code =  $_POST['code'];
					  
					   $m             = new formModel();
        			   $m->sql_nativo = " SELECT count(*) as total FROM form017  WHERE code in ('".$code."') and dato45 in ('".AGENCY_ID."') ";
        			   $m->internal   = true;
        			   $res           = $m->all();
                       
                       $view = $res[0]['total'];
					
					   }

				}


				$m 				= new formModel();
				$m->table  		= _track_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->user    	= $userId;
				$m->code     	= $code;
			    $m->dato03 	    = $_POST['url'];
			    $m->dato04 	    = $_POST['device'];
			    $m->dato05 	    = $view;
			    $m->dato06 	    = $cta;
			    $m->dato07 	    = $_POST['cta'];
			    $m->dato08		= $_POST['date'];	
			    $m->dato09		= $_POST['referer'];			    
			    $m->dato11		= $_POST['languages'];			    
			    $m->dato12		= $_POST['region'];			    
			    $m->dato13		= $_POST['country'];			    
			    $m->dato14		= $_POST['ip'];	
			    $m->dato15		= $_POST['agent'];			    
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato10 	    = $type;
			    $m->dato40 	    = AGENCY_ID;
	    		$m->save();
	    		echo $code;

	}else{
		echo "Bad";
	}
    exit;


?>