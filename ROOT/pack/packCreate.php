<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

	UsageAPI('packCreate',AGENCY_ID,AGENT_ID,AGENT_NAME);

    $m              = new formModel();
    $m->table       = _pack_;
    $m->user        = AGENT_ID;
    $m->archived    = 'no';
    $m->created     = $m->now__();
    $m->updated     = $m->now__();
	$m->code     	= createCode(_pack_);
	$m->token   	= createToken(_pack_);
	$link           = createLink(_pack_);
	$m->link   	    = $link;
    $m->dato03      = '4 hours';   
    $m->dato06      = '10';   
    $m->dato07      = '3';
    $m->dato08      = '50000.00';    
    $m->dato13      = sg($_POST['pack_departure_location'],100);        
    $m->dato14      = trim(str_replace(" ", "-", strtolower($_POST['pack_name'])));  
    $m->dato01      = sg($_POST['pack_name'],50); /* nombre */
    $m->dato05      = sg($_POST['pack_contact'],50); /* contacto */
    $m->dato15      = sg($_POST['pack_phone'],20); /* phone */
    $m->dato10      = sg($_POST['pack_status'],20); /* phone */
    $m->dato32      = sg($_POST['pack_category'],20); /* phone */

    $m->dato12      = 'No';
    $m->dato40      = AGENCY_ID; 
    $m->dato45      = AGENCY_ID; 
    $id 			= $m->save();

    if($id>0){
        echo jsonOut($link);
    }

    exit;

}