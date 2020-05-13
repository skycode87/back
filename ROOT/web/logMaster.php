<?php
include_once "../main/common.php";
include_once "../main/log.php";
include_once "web.php";


if($request[0]=='single'){ 
$webId     = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);
$database = master(_log_,'log','null','null',$LOG,AGENCY_ID," dato40 in ('".$webId."') order by id desc ");
}else{
$database = master(_log_,'log','null','null',$LOG,AGENCY_ID," 1=1 order by id desc");
}


echo json_encode($database);
return 0;

exit;
