<?php
include_once "../main/common.php";
include_once "../main/agency.php";
include_once "app.php";
include_once "pack.php";
include_once "agent.php";





		$sql  		   = "SELECT id,dato45,dato41,token FROM form001 where link in ('".TOKEN_OBJECT."') and archived='no' limit 1"; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        
        if(!$res[0]['id']){
        	echo 'error';
        	exit;
        } 




        $planId 	=  $res[0]['id'];
        $planToken	=  $res[0]['token'];
        $packId 	=  $res[0]['dato41'];
        $AGENCY_ID  =  $res[0]['dato45'];


		$packDatabase  = single(_pack_,'pack',$packId,'null','null',$PACK,$AGENCY_ID);

		$agentDatabase = single(_agent_,'agent',AGENT_ID,'null','agent_password,agent_alias',$AGENT,AGENCY_ID);
   
		$gallery = false;

		$agencyDatabase  = single(_agency_,'agency',$AGENCY_ID,'null','null',$AGENCY,$AGENCY_ID);



		if ( strlen($packDatabase[0]['pack_gallery']) > 20 ){

					$gallery = true;
                    $urlGallery = $agencyDatabase[0]['agency_gallery_cluuf'];
					
		}else{
					$urlGallery = '';

		};	



if(AGENCY_ID){



   	    if($planId){

			$m = new formModel();
			$m->table   	   = _plan_;
			$m->dato10 		   = '2'; 
			$m->dato14 		   = $m->now__(); 
			$m->updated        = $m->now__();
			$m->updated($planId);
			ok();






		if($request[0]=='no'){
			
		}else{
		   $database   = master(_app_,'app','app_id,app_token','null',$APP,AGENCY_ID," dato10 in (1) and dato41 in ('".$planId."') ");
		  




		   	foreach ($database as $key) {

				$database__ = AppByID($key['app_id']);		
				if($gallery){
					$href = $urlGallery."/plan.html?plan=".$planToken."&user=".$key['app_token'];
					$botonGallery = "<a href='".$href."' style='padding: 10px 40px;background: #42bb6b; color: #fff;font-size: 16px; font-weight: bold;border-radius: 10px;' >Go to Gallery</a>";
				}else{
					$botonGallery = "";
					$href="";
				}


			      		$SYSTEM       = ContentEmailByID($agency);

				    	$data['body'] = "<p style='font-size:14px; line-height:18px;text-align: justify; !important'>
				        ".$database__['pack_email_closure']."
				        </p>
				        <p style='text-align:center'>".$botonGallery."</p>
				        <p style='text-align:center'>
				            ".$SYSTEM['sys_email_footer']."
				        </p>";
				    

     					sendEmail__($database__, "Thanks for choosing us!", $data['body']);
		  


		   	}


		  
		  


		   sendEmailToEmail__($database__, "Thanks for choosing us!", $data['body'],$agentDatabase[0]['agent_email']);


		    sendEmailToEmail__($database__, "Thanks for choosing us!", $data['body'],$agencyDatabase[0]['agency_email']);

	   
										$payload = array(
								        'payload' => json_encode(array(
								            'attachments' => array(
								                0 => array(
								                    'fallback' => 'Tour Closed',
								                    'color' => '#7ADF6E',
								                    'text' => count($database).' e-mails sent ',
								                    'title' => 'Go to Gallery',
								                    'title_link' => $href,
								                    'footer' => 'Capture Colombia Tours',
								                    'footer_icon' => ''
								                )
								            )
								        ))
								    	);
								      
				slack_($payload);  

								



		}


   	
   	}else{
   	
   		echo "error";
   	
   	}		

}




?>