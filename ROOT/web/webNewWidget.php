<?php
include_once "../main/common.php";
include_once "blog.php";


if(($method==='GET')&&(AGENCY_ID)){

	 
	   				$m = new formModel();
					$m->table   	= _web_;
					$m->dato01      = 'Lorem Ipsum'; 
					$m->dato41     	= intval($request[1]); 
				    $m->dato45 	    = AGENCY_ID;
				    $m->dato40 	    = AGENCY_ID;
					$m->updated     = $m->now__();
					$m->archived    = 'no';
					$m->dato10    	= '8';
				    $m->token 		= $token = createToken(_web_);
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