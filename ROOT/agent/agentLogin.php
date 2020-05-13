<?php
include_once "../main/common.php";
include_once "../main/agent.php";
include_once "../main/agency.php";


if(($method==='POST')){

        $m = new formModel();
        $m->table       = _agent_;
        $m->select      = "id,dato45";
        $m->extra_sql__ = "order by id desc";   
        $m->where__('archived','=','no');
        $m->where__('dato04','=',$_POST['login']);
        $m->where__('dato05','=',$m->md7__($_POST['password']));
        $m->internal = true;
        $res =  $m->all();

        if($res[0]['id']){

        $agentId =$res[0]['id'];

        $_SESSION['AGENCY_ID']   = $res[0]['dato45'];  

        $agent             = single(_agent_,'agent',$agentId,'null','null',$AGENT,$_SESSION['AGENCY_ID']);

        $agency             = single(_agency_,'agency',$_SESSION['AGENCY_ID'],'null','null',$AGENCY,$_SESSION['AGENCY_ID']);
        
        $database['agent']   = $agent[0];
        $database['agency']  = $agency[0];

        echo json_encode($database);

        }else{
                echo "error";
        }

/*

        
        if($res[0]){
        $cURLConnection = curl_init();
        notify($_POST['login']." inicio sesion");
        echo json_encode($res);
        }else{
        notify($_POST['login']." :male-police-officer: Intento Fallido de sesion");
        echo json_encode($res);
        }
        exit;
*/


}





