<?php
include_once "../main/common.php";
include_once "web.php";



if(($method==='POST')&&(AGENCY_ID)){

	$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);

	

   	if($webId){


   				// Guardar el Log

   				$webRows  =  single(_web_,'web',$webId,'null','null',$WEB,AGENCY_ID);
   				$array    = $webRows[0];
   				$array2   = $_POST;
   				$changes  = '';
   				
				foreach ($array as $key => $value) {
						foreach ($array2 as $key2 => $value2) {
							if($key2==$key){
								if($value!=$value2){ 
									$changes.= ' Row:'.$key2.'<br> Before:'.$value."<br>After:".$value2."<br><hr>";
								}
							}
						}
				}				     
   				
   				if($changes!=''){
						$m 				= new formModel();
						$m->table  		= _log_;
						$m->archived	= 'no';
						$m->created 	= $m->now__();
						$m->updated 	= $m->now__();
						$m->user    	= AGENT_ID;
						$m->code     	= createCode(_log_);
						$m->token   	= createToken(_log_);
						$m->dato01     	= $changes;
						$m->dato02     	= $_SESSION['AGENT_NAME'];
						$m->dato03     	= $_SESSION['AGENT_AVATAR'];
						$m->dato04     	= _web_;
						$m->dato40     	= $webId;
						$m->dato41     	= AGENT_ID; 
					    $m->dato45 	    = AGENCY_ID;
					    $m->dato10 	    = 3;
			    		$m->save();
	    	    }

   				// Guardar el Log




				$m = new formModel();
				$m->table   	   = _web_;
				$m->dato01         = trim(strtolower($_POST['web_name'])); 
				$m->dato07     	= trim($_POST['web_title']); 
				$m->dato05     	= trim($_POST['web_description']); 
				$m->dato08     	= trim($_POST['web_subtitle']); 
				$m->dato41     	= $_POST['web_root']; 
			    $m->dato09 	    = $_POST['web_url_title'];
			    $m->dato06 	    = $_POST['web_url'];
			    $m->dato11 	    = $_POST['web_icon'];
			    $m->dato10 	    = $_POST['web_type'];
			    $m->dato02 	    = $_POST['web_value'];
			    $m->dato13 	    = $_POST['web_rows'];
			    $m->dato03 	    = $_POST['web_category'];
			    $m->dato12 	    = $_POST['web_visible'];
			    $m->dato31 	    = $_POST['web_content_quill'];
			    $m->dato45 	    = AGENCY_ID;
			    //$m->dato03 	    = addCategory(AGENCY_ID,$_POST['web_root']);
			    $m->dato04 	    = $_POST['web_order'];
				$m->updated        = $m->now__();
				$m->updated($webId);
		
   	}else{
		notify('Error en webUpdateWidget :'.AGENCY_ID);
   	}

}

?>


