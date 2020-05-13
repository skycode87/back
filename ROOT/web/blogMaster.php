<?php
include_once "../main/common.php";
include_once "blog.php";




$database['blog']   = master(_blog_,'blog','blog_token,blog_title,blog_created,blog_type,blog_schedule','null',$BLOG,AGENCY_ID);


 echo json_encode($database);
    return 0;
    exit;






