<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once "../main/common.php";
include_once "../main/agency.php";
include_once "pack.php";
include_once "app.php";

if(($method==='GET')){

        $m = new formModel();
        $m->sql_nativo = "SELECT id,dato45  FROM form004  WHERE   code in ('".$action."');"; 
        $m->internal   = true;
        $res           = $m->all();
        $packId        =  $res[0]['id'];
        $agencyId      =  $res[0]['dato45'];

        $packRow = 'pack_name,pack_token,pack_price,pack_max_limit,pack_min_limit';
        $database['pack'] = single(_pack_,'pack',$packId,$packRow,'null',$PACK,$agencyId);
  




        $m = new formModel();
        $m->sql_nativo = "SELECT id,dato45  FROM "._ref_."  WHERE code in ('".$request[0]."');"; 
        $m->internal   = true;
        $res           = $m->all();
        $refId         =  $res[0]['id'];

        $refRow = 'ref_fullname,ref_token,ref_email';
        $database['ref'] = single(_ref_,'ref',$refId,$refRow,'null',$REFERER,$agencyId);



        $m                = new formModel();
        $m->sql_nativo    = "SELECT f.dato01, f.dato40 as 'pack'  from form004 p, form013 f where f.dato40=p.id and f.dato10 in (2) and p.id in (".$packId.") and f.archived='no' ";
        $m->internal      = true;
        $database['departureTime'] = $m->all();


        $agencyRow          = 'agency_token';
        $database['agency'] = single(_agency_,'agency',$agencyId,$agencyRow,'null',$AGENCY,$agencyId);

        echo json_encode($database);


return 0;
exit;
}





