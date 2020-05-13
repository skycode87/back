<?php
include_once "../main/common.php";
include_once "blog.php";


if(($method==='POST')&&(AGENCY_ID)){

	    UsageAPI('webUpdateContent',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$id 	   = objectID(_blog_,TOKEN_OBJECT,AGENCY_ID);


   	if($id){
		        $m = new formModel();
		        $m->table   	= _blog_;
				$m->dato31     	= trim($_POST['blog_content_quill']); 
				$m->dato41     	= 1; 
				$m->updated     = $m->now__();
				$res = $m->updated($id);
		
        updateServer('https://lospatioshb.com/blog/loadData.php?token='.TOKEN_OBJECT);

   	}else{
		notify('Error en webUpdateContent :'.AGENCY_ID);
   	}
		
}

?>