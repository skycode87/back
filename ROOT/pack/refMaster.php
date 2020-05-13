<?php
include_once "../main/common.php";
include_once "pack.php";


if(($method==='GET')&&(AGENCY_ID)){

    $appId      = objectID(_app_,TOKEN_OBJECT,AGENCY_ID);
    $ref__  = master(_ref_,'ref','null','null',$REFERER,AGENCY_ID);
    $database['ref'] = $ref__ ;
    echo json_encode($database);

exit;

}

