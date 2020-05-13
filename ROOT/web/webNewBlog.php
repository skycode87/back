<?php
include_once "../main/common.php";
include_once "blog.php";



if(($method==='GET')&&(AGENCY_ID)){

	    UsageAPI('webNewBlog',AGENCY_ID,AGENT_ID,AGENT_NAME);

	 
	   		
			        $m = new formModel();
			        $m->table   	= _blog_;
					$m->dato02      = 'Lorem ipsum dolor sit amet.'; 
					$m->archived   	= 'no'; 
					$m->dato41     	= 1; 
					$m->code     	= createCode(_blog_);
				    $m->token 		= $token = createToken(_blog_);
				    $m->dato45 	    = AGENCY_ID;
					$m->updated     = $m->now__();
					$id = $m->save();

					if($id>0){
						echo $token;
					}else{
						echo 'error';
					}


}else{
			echo "error";
			notify('Error en webNewBlog :'.AGENCY_ID);
			exit;
}



?>