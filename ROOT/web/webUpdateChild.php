<?php
//include_once "../main/common.php";
//include_once "web.php";

echo "ok";

/*
if(($method==='POST')&&(AGENCY_ID)){

	    //UsageAPI('webUpdateChild',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$webId 	   = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);


	print_r($_POST);

	exit;
     
   	if($webId){
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
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato03 	    = addCategory(AGENCY_ID,$_POST['web_root']);
			    $m->dato04 	    = $_POST['web_order'];
		$m->updated        = $m->now__();
		$m->updated($webId);
		
        updateServer('https://capturecolombiatours.com/loadData.php');

   	}else{
		notify('Error en webUpdateChild :'.AGENCY_ID);
   	}

		
}*/

?>