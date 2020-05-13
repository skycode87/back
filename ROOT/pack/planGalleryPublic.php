<?php
include_once "../main/common.php";
include_once "app.php";
include_once "pack.php";


  		  $sql  = "SELECT dato45,dato41,dato30,dato01,dato03 FROM form001 where token in ('".$action ."') and archived='no' limit 1"; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res1           = $m->all();

        $AGENCY_ID  = $res1[0]['dato45'];
        $packId   =  $res1[0]['dato41'];
  


        $packDatabase  = single(_pack_,'pack',$packId,'pack_name','null',$PACK,$AGENCY_ID);


		//echo strlen($packDatabase[0]['pack_gallery']);	

		    $sql  = "SELECT id,dato45,dato42 FROM form005 where token in ('".$request[0]."') and archived='no' limit 1"; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res           = $m->all();

        $AGENCY_ID2    =  $res[0]['dato45'];

        if($AGENCY_ID2!=$AGENCY_ID) exit;

        $sql  = "SELECT  dato01,dato02 FROM form006 where id in ('".$res[0]['dato42']."')  "; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res3           = $m->all();



        $sql  = "SELECT  dato01,dato02 FROM form003 where id in ('".$res[0]['dato42']."')  "; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $res3           = $m->all();



        $sql  = "SELECT  dato30,dato08,dato07  FROM form003 where id in ('".$AGENCY_ID2."') limit 1 "; 
        $m             = new formModel();
        $m->sql_nativo = $sql;
        $m->internal   = true;
        $agency           = $m->all();



        $resultado['gallery'] = json_decode($res1[0]['dato30']);
        $resultado['data']    = $res1[0];
        $resultado['user']    = $res3[0];
        $resultado['agency']  = $agency[0];
        $resultado['pack']  = $packDatabase[0];

        echo json_encode($resultado);


?>