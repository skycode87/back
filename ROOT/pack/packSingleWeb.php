<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once "../main/common.php";
include_once "pack.php";




function PackSingleByID($packId){

        $sql = "SELECT        
              pack.dato01     AS 'pack_name',
              pack.dato03     AS 'pack_duration',
              pack.dato08     AS 'pack_price',
              pack.dato10     AS 'pack_status',
              pack.dato15     AS 'pack_phone', 
              pack.dato06     AS 'pack_max_limit', 
              pack.dato07     AS 'pack_min_limit',         
              pack.dato13     AS 'pack_departure',
              pack.dato19     AS 'pack_cupon',
              pack.dato29     AS 'pack_image',                                       
              pack.dato30     AS 'pack_gallery',
              pack.dato31     AS 'pack_avatar',
              pack.dato32     AS 'pack_category',      
              pack.dato37     AS 'pack_summary',
              pack.dato38     AS 'pack_itinerary',
              pack.dato39     AS 'pack_maps_iframe',
              pack.token      AS 'pack_token',
              pack.dato45     AS 'pack_agencyId'
              FROM   form004 pack 
              WHERE  pack.id in ('".$packId."') 
                     AND pack.archived   = 'no'
                     AND pack.dato10 = '0' ";

            $m = new formModel();
            $m->sql_nativo = $sql;
            $m->internal = true;
            $res = $m->all();      
            return $res[0];
}


function PacksByCategory($category){

  $sql = "SELECT  
        pack.dato01     AS 'pack_name',
        pack.dato03     AS 'pack_duration',
        pack.dato05     AS 'pack_contact',        
        pack.dato08     AS 'pack_price',
        pack.dato10     AS 'pack_status',
        pack.dato15     AS 'pack_phone', 
        pack.dato13     AS 'pack_departure',                        
        pack.dato31     AS 'pack_url_avatar',
        pack.dato32     AS 'pack_category',      
        pack.token      AS 'pack_token'       
        FROM form004 pack 
        WHERE   pack.dato32 = ('".trim($category)."') and pack.archived = 'no' ";

      $m = new formModel();
      $m->sql_nativo = $sql;
      $m->internal = true;
      $res = $m->all();     

      return $res;
}





if(($method==='GET')){




        $m             = new formModel();
        
        $m->sql_nativo = " SELECT id FROM form004 WHERE  (  REPLACE(dato14,'-','') LIKE '%".$action."%' OR  token in ('".$action."') )";
    
        $m->internal   = true;
        
        $res           = $m->all();

        $pack__['id']  =  $res[0]['id'];

    
        if(!$pack__['id']){
         // notify('el pack del website no contiene ID, revisar packSingleWeb.php');
          exit;
        }


        $database['pack'] = PackSingleByID($pack__['id']);

        if($database['pack']['pack_cupon']==$request[1]){

              $m = new formModel();
          
              $m->sql_nativo = "SELECT id as 'id', dato03 as 'price' , code as 'code' FROM form018 i WHERE   i.dato01 in ('".$request[1]."') and i.archived='no' and i.dato10='0' limit 1 ";
          
              $m->internal       =  true;
              $cupones           = $m->all();
              $database['cupon'] = $cupones[0];

              if($database['cupon']['id']){
                  $m          = new formModel();
                  $m->table   = "form018";
                  $m->dato10  = '1'; 
                  $m->updated($database['cupon']['id']);
              }else{
                 $database['cupon']['code'] = 'null';
              }
        }



    $m = new formModel();
   
    $m->sql_nativo = "SELECT f.dato01, f.dato40 as 'pack'  from form004 p, form013 f where f.dato40=p.id and f.dato10 in (2) and p.id in (".$pack__['id'].")";
   
    $m->internal = true;
    
    $database['departureTime'] = $m->all();

    $database['Packs'] = PacksByCategory($database['pack']['pack_category']);
   



    $m = new formModel();
   
    $m->sql_nativo = "SELECT p.dato01 as 'dato01' , p.dato10 as 'type' FROM form013 p WHERE  p.dato40 in ('".$pack__['id']."') and p.archived = 'no'";
   
    $m->internal = true;
   
    $database['features'] = $m->all();




    $m = new formModel();

    $m->sql_nativo = "SELECT i.dato01 as 'url', i.dato05 as 'name' , i.dato03 as 'type' , i.dato02 as 'description' , i.dato06 as 'url1', i.dato03 FROM form012 i WHERE  i.dato03 <> 'avatar'  and  i.dato02 = 'package' and i.dato40 in (".$pack__['id'].") and i.archived='no' ";

    $m->internal = true;

    $database['images'] = $m->all();



    $m = new formModel();

    $m->sql_nativo = "SELECT token FROM form003 WHERE id in (".$database['pack']['pack_agencyId'].") and archived='no' ";

    $m->internal = true;

    $database['agency'] = $m->all();

    $database['tokenPublic'] = $database['agency'][0]['token'];   

    echo json_encode($database);

return 0;
exit;
}





