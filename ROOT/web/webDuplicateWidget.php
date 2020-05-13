<?php
include_once "../main/common.php";
include_once "web.php";



if(($method==='POST')&&(AGENCY_ID)){

	$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);


   	if($webId){

				$m = new formModel();
				$m->table   	= _web_;
				$m->dato01      = $_POST['web_name']; 
				$m->dato07     	= $_POST['web_title']; 
				$m->dato05     	= $_POST['web_description']; 
				$m->dato08     	= $_POST['web_subtitle']; 
			    $m->dato41     	= $_POST['web_root']; 
			    $m->dato09 	    = $_POST['web_url_title'];
			    $m->dato06 	    = $_POST['web_url'];
			    $m->dato11 	    = $_POST['web_icon'];
			    $m->dato10 	    = $_POST['web_type'];
			    $m->dato02 	    = $_POST['web_value'];
			    $m->dato31 	    = $_POST['web_content_quill'];
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato40 	    = AGENCY_ID;
			    //$m->dato03 	= addCategory(AGENCY_ID,$_POST['web_root']);
			    $m->dato04 	    = $_POST['web_order'];
			    $m->updated     = $m->now__();
				$m->archived    = 'no';
		        $m->token 		= $token = createToken(_web_);

				$id = $m->save();

					if($id>0){
						echo $token;
					}else{
						echo 'error';
					}
		
        //updateServer('https://capturecolombiatours.com/loadData.php');

   	}else{
		notify('Error en webDuplicateWidget :'.AGENCY_ID);
   	}

}

?>


