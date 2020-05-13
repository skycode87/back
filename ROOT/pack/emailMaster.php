<?php
include_once "../main/common.php";


if(($method==='GET')&&(AGENCY_ID)){

    $email__  = master(_email_,'email','null','null',$EMAIL,AGENCY_ID," 1=1 order by id desc limit 100");
    $database['email'] = $email__ ;
    echo json_encode($database);

exit;

}

