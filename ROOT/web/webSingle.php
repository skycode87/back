<?php
include_once "../main/common.php";
include_once "web.php";
include_once "master.php";


$webId      = objectID(_web_,TOKEN_OBJECT,AGENCY_ID);

if($webId){
$webSingle              = single(_web_,'web',$webId,'null','null',$WEB,AGENCY_ID);

$database['root']       = master(_web_,'web','web_name,web_id','null',$WEB,AGENCY_ID," dato10 in (1) ");


$database['type']       = $WEB_TYPE;

$database['struct']     = masterPublic(_master_,'master','master_name,master_id,master_description','null',$MASTER,AGENCY_ID," dato40 in (3) ");



$database['webSingle']  = $webSingle[0];
echo json_encode($database);
exit;
}else{
  echo 'error';
}







