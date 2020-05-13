<?php
include_once "../main/common.php";
include_once "pack.php";


if(($method==='GET')&&(AGENCY_ID)){

	$refId = objectID(_ref_,TOKEN_OBJECT,AGENCY_ID);


	if(!$refId) exit;

    $ref__  = single(_ref_,'ref',$refId,'null','null',$REFERER,AGENCY_ID);
  
    $database['ref'] = $ref__[0] ;
  
    echo json_encode($database);

exit;

}

