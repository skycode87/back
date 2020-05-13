<?php
include_once "../main/common.php";

if(AGENCY_ID){

        $m             = new formModel();
        $m->sql_nativo = "SELECT id FROM form004 WHERE  (  REPLACE(dato14,'-','') LIKE '%".TOKEN_OBJECT."%'  OR  token in ('".TOKEN_OBJECT."') )";
        $m->internal   = true;
        $res           = $m->all();
        $packId        = $res[0]['id'];

        $_POST['dato10']         = 1;
        $fecha                   = $_POST['plan01'];
        $hora                    = $_POST['plan04'];
        $user_document           = $_POST['user02'];    
        $user_nacionality        = $_POST['user06'];    
        $user_additional_info    = $_POST['user12'];    
        $user_fullname           = $_POST['user01'];    
        $user_email              = $_POST['user04'];  
        $cupon                   = $_POST['code'];
        $type                    = $request[0];

        $m           = new formModel();
        $m->table    = _form_;
        $m->archived = 'no';
        $m->created  = $m->now__();
        $m->updated  = $m->now__();
        $m->dato01   = ucfirst(strtolower($user_fullname));
        $m->dato02   = strtolower($user_email);
        $m->dato03   = "main";

        $code        = createCode(_form_);
        $m->code     = $code;

        $m->dato04   = strtolower($user_additional_info);
        $m->dato05   = strtoupper($user_nacionality);
        $m->dato06   = $user_document;
        $m->dato07   = $type;
        $m->dato08   = $request[1];

        if($packId)    $m->dato40   = $packId;
        $m->dato45   = AGENCY_ID;
        $m->dato42   = AGENCY_ID;
        $id          = $m->save();
        
        if($id){
            echo $code;
        }else{
            echo 'error';
        }

 }else{
    echo 'error';
 }

?>