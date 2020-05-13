<?php
include_once "../main/common.php";
include_once "agent.php";


$id      = objectID(_agent_,TOKEN_OBJECT,AGENCY_ID);

if($id){
$single              = single(_agent_,'agent',$id,'null','null',$AGENT,AGENCY_ID);
$database['agent']  = $single[0];
echo json_encode($database);
exit;
}else{
  echo 'error';
}




