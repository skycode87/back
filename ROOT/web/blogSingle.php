<?php
include_once "../main/common.php";
include_once "blog.php";


$id      = objectID(_blog_,TOKEN_OBJECT,AGENCY_ID);


if($id){
$single              = single(_blog_,'blog',$id,'null','null',$BLOG,AGENCY_ID);
$database['blog']  = $single[0];
echo json_encode($database);
exit;
}else{
  echo 'error';
}




