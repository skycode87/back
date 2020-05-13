<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){
	
    UsageAPI('packAddImage',AGENCY_ID,AGENT_ID,AGENT_NAME);
	   
    $packId 	   = objectID(_pack_,TOKEN_OBJECT,AGENCY_ID);
 

	   		if($packId){

		            $m           = new formModel();
		            $m->table    = _file_;
		            $m->archived = 'no';
		            $m->created  = $m->now__();
				    $m->updated  = $m->now__();
					$m->code     = createCode(_file_);
					$m->token    = createToken(_file_);
					$m->link     = createLink(_file_);
		            $m->dato01   = $_POST['dato01'];
		            $m->dato03   = $_POST['dato03'];
		            $m->dato02   = $_POST['dato02'];
		            $m->dato04   = $_POST['dato02'];
		            $m->dato40   = $packId;
		            $m->dato45   = AGENCY_ID;
		            $id          = $m->save();
		            echo $id;
		            exit;
            
   			}else{
				 //notifySystem('Error packAddImage',1);
			}
    
    exit;
}

?>
          

