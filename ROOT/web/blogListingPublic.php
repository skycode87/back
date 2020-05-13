<?php
include_once "../main/common.php";
include_once "blog.php";



$where = ' blog.dato10 in (1) ';

$database['blog']   = master(_blog_,'blog','null','blog_id,blog_content',$BLOG,AGENCY_ID,$where);


    echo json_encode($database);
    return 0;
    exit;






