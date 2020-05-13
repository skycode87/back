<?php
include_once "../main/common.php";
include_once "pack.php";

if(($method==='GET')&&(AGENCY_ID)){


      if(($request[1]) && ($request[2])){

            $desde = $request[1];
            $hasta = $request[2];

      }else{

            $desde = date('Y-m-d');
            $hasta = date('Y-m-d');

      }




       

  
        $sql = "SELECT count(*) as total  FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."') AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND pack.archived = 'no' and user.dato01 <> '' ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['apps']   = $res;
      



/**************************/




    $sql = "SELECT count(*) as total, pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND pack.archived = 'no' and user.dato01 <> '' group by plan.id order by total desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByPack']   = $res;


/**************************/


 $sql = "SELECT count(pack.dato01) as total, pack.dato01 as pack  FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND pack.archived = 'no' and user.dato01 <> '' group by pack.dato01 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByPackSingle']   = $res;



      /**************************/


$sql = "SELECT count(*) as total, pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato18 = 'Website' AND pack.archived = 'no' and user.dato01 <> '' group by plan.id ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByWebPlan']   = $res;



$sql = "SELECT  pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato18 = 'Website' AND pack.archived = 'no' and user.dato01 <> '' ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByWebDetails']   = $res;




/**************************/


$sql = "SELECT count(*) as total, pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate, app.dato18 as agentName FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato09 = 'local' AND pack.archived = 'no' and user.dato01 <> '' group by plan.id ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByLocalPlan']   = $res;



      $sql = "SELECT pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate, app.dato18 as agentName FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato09 = 'local' AND pack.archived = 'no' and user.dato01 <> ''  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByLocalDetails']   = $res;


/**************************/


$sql = "SELECT count(*) as total, pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate, app.dato18 as agentName FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato09 <> 'local'  AND app.dato18 <> 'Website' AND pack.archived = 'no' and user.dato01 <> '' group by plan.id order by total desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByRefererPlan']   = $res;


$sql = "SELECT  pack.dato01 as pack , plan.dato03 as departureTime ,plan.dato01 as departureDate, app.dato18 as agentName FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato09 <> 'local'  AND app.dato18 <> 'Website' AND pack.archived = 'no' and user.dato01 <> ''  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByRefererDetails']   = $res;



$sql = "SELECT  count(app.dato18) as total, app.dato18 as 'agentName'  FROM form003 agency inner join form004 pack on pack.dato40 = agency.id inner join form001 plan on plan.dato41 = pack.id inner join form005 app on app.dato41 = plan.id inner join form006 user on app.dato42 = user.id inner join form008 ref on ref.id = app.dato40 WHERE agency.id IN ('".AGENCY_ID."')  AND app.archived = 'no' AND DATE_FORMAT(app.created,'%Y-%m-%d') >= '".$desde."' AND DATE_FORMAT(app.created,'%Y-%m-%d') <= '".$hasta."' AND app.dato09 <> 'local'  AND app.dato18 <> 'Website' AND pack.archived = 'no' and user.dato01 <> ''  group by app.dato18 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['appsByRefererName']   = $res;


      echo json_encode($data);
}