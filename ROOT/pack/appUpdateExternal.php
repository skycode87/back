<?php
include_once "../main/common.php";


if(($method==='POST')&&(AGENCY_ID)){

   
    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);
    $userId     = findRow(_app_,'id',$appId,' dato42 ');


    if( ( $appId ) && ( $userId ) ){

	$m = new formModel();
	$m->table   	   = _user_;
	$m->dato01 		   = ucfirst(strtolower($_POST['user_fullname'])); 
	$m->dato04 		   = strtolower($_POST['user_email']); 
	$m->updated        = $m->now__();
	$m->updated($userId);
	
    }else{
    	echo "error en ID";
    }

exit;


}

?>