<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

   

	$m = new formModel();
	$m->table   	   = _agency_;
	$m->dato01 		   = ucfirst(strtolower($_POST['agency_name'])); 
	$m->dato02         = ucfirst(strtolower($_POST['agency_email'])); 
	$m->dato03         = strtolower($_POST['agency_phone']); 
	$m->dato05         = strtolower($_POST['agency_whatsapp']); 
	$m->dato08         = strtolower($_POST['agency_domain']); 
	$m->dato09         = strtolower($_POST['agency_owner']); 
	$m->dato11         = strtolower($_POST['agency_privateemail']); 
	$m->dato12         = strtolower($_POST['agency_alias']); 
	$m->dato13         = strtolower($_POST['agency_facebook']); 
	$m->dato14         = strtolower($_POST['agency_youtube']); 
	$m->dato15         = strtolower($_POST['agency_tripadvisor']); 
	$m->dato16         = strtolower($_POST['agency_address']); 
	$m->dato17         = ucfirst(strtolower($_POST['agency_city'])); 
	$m->dato18         = strtolower($_POST['agency_header_color']); 
	
	$m->dato22         = $_POST['agency_email_confirmation_subject']; 
	$m->dato23         = $_POST['agency_email_maximo_subject']; 
	$m->dato24         = $_POST['agency_email_minimo_subject']; 

	$m->dato32  	   = str_replace("'","\"", $_POST['agency_email_confirmation_body']);	
	$m->dato33  	   = str_replace("'","\"", $_POST['agency_email_maximo_body']);	
	$m->dato34  	   = str_replace("'","\"", $_POST['agency_email_minimo_body']);	
	$m->dato35  	   = str_replace("'","\"", $_POST['agency_email_footer']);	
	$m->updated 	   = $m->now__();

	$m->updated(AGENCY_ID);
	

			
exit;


}

?>