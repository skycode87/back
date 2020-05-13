<?php
include_once "../main/common.php";
include_once "../main/agency.php";
include_once "pack.php";

if(($method==='GET')&&(AGENCY_ID)){
  

     if(($request[1]) && ($request[2])){

            $desde = $request[1];
            $hasta = $request[2];

      }else{

            $desde = date('Y-m-d');
            $hasta = date('Y-m-d');

      }

    $sql = "SELECT count(*) as total  FROM `form017` where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."' and dato45 in (".AGENCY_ID.") order by 1 desc  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pagesDetails']   = $res;



  
        $sql = "SELECT count(dato03) as total,  dato03 as page FROM `form017` where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."'  and dato45 in (".AGENCY_ID.") group by dato03 order by 1 desc limit 12 ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pages']   = $res;
      



     $sql = "SELECT count(code) as total,  code as code , dato02 as ip FROM `form017` where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."' and dato45 in (".AGENCY_ID.") group by code order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pagesByCode']   = $res;
      



     $sql = "SELECT count(dato03) as total,  dato03 as ip  FROM `form017` where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."'  and dato45 in (".AGENCY_ID.") group by dato03 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pagesByIP']   = $res;




     $sql = "SELECT  dato03,dato05,code,DATE_FORMAT(created,'%Y-%m-%d %h:%i %p') as created  FROM `form017` where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."' and dato45 in (".AGENCY_ID.") order by code desc, dato05 desc  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pagesByFlow']   = $res;



     $sql = "SELECT  count(code) as total, code as code  FROM form017 where DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."' and dato45 in (".AGENCY_ID.") group by  code order by 1 desc  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['pagesByFlowCode']   = $res;


      foreach ($data['pagesByFlowCode'] as $key) {       


          if($key['code']!='null'){

               $sql = "select dato03 as url,dato07 as cta, dato05 as pos, DATE_FORMAT(created,' %h:%i %p  %W %d %M %Y ')  as date , dato10 as type from form017 where  DATE_FORMAT(created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(created,'%Y-%m-%d') <= '".$hasta."'  and code = '".$key['code']."' and dato45 in (".AGENCY_ID.") ORDER BY `pos` ";
                $m              = new formModel();
                $m->sql_nativo  = $sql;
                $m->internal    = true;
                $data['pagesByFlowCode']['user'][$key['code']] = $m->all(); 

          }


      }




 
/*
      $sql = "SELECT count(cta.dato07) as total,cta.dato07 as name,web.dato11  as url FROM form017 cta left join form020 web on web.dato02 = cta.dato07 WHERE cta.dato07<>'' and DATE_FORMAT(cta.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(cta.created,'%Y-%m-%d') <= '".$hasta."' and web.dato45 in (".AGENCY_ID.") GROUP by cta.dato07 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['ctaAll']   = $res;*/


   /* retorna todos los CTAs con o sin imagen de referencias de la tabla web */


     $sql = "SELECT web.dato11  as url ,web.dato02 as name  FROM form020 web WHERE web.dato45 in (".AGENCY_ID.") ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['ctaAll']   = $res;

/****/

   $sql = "
SELECT web.dato11 as url, web.dato02 as name, web.dato03 as details, web.dato04 as position FROM form020 web WHERE web.dato45 in (".AGENCY_ID.") and web.dato10 = 13 and web.archived = 'no' and web.dato02 <> '' ";

      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['ctaImages']   = $res;





      

  $sql = "SELECT count(cta.dato07) as total,cta.dato07 as name FROM form017 cta WHERE cta.dato07<>'' and  DATE_FORMAT(cta.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(cta.created,'%Y-%m-%d') <= '".$hasta."' and cta.dato45 in  (".AGENCY_ID.")  GROUP by cta.dato07 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['ctaList']   = $res;




  /* CALCULA LA CANTIDAD DE LOS REFERIDOS , NO INCLUYE LOS QUE DICEN CAPTURE EN SU URL */



$singleSkipUrls = single(_agency_,'agency',AGENCY_ID,'agency_skip_urls_referrals','null',$AGENCY,AGENCY_ID);



if(is_array(json_decode($singleSkipUrls[0]['agency_skip_urls_referrals']))){
      $arrayUrls = json_decode($singleSkipUrls[0]['agency_skip_urls_referrals']);
      foreach ($arrayUrls as $key ) {
          $sqlSkipUrl = $sqlSkipUrl ." and web.dato09 not like '%".$key."%' ";
      }
}else{
      $sqlSkipUrl = "";
};








$sql = "SELECT count(web.dato09) as total,web.dato09 as name FROM form017 web where web.dato09 <> ''  and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."' ".$sqlSkipUrl." and web.dato45 in (".AGENCY_ID.") group by web.dato09  order by 1 desc  ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['refererUrl']   = $res;




        /* CALCULA DISPOSITIVO DE NAVEGACION */


  $sql = "SELECT count(web.dato04) as total,web.dato04 as name FROM form017 web where web.dato04 <> '' and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."'  and web.dato45 in (".AGENCY_ID.")  group by web.dato04 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['dispositivosTotal']   = $res;



        /* CALCULA IDIOMA */


  $sql = "SELECT count(web.dato11) as total,web.dato11 as name FROM form017 web where web.dato11 <> '' and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."'  and web.dato45 in (".AGENCY_ID.")  group by web.dato11  order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['languageTotal']   = $res;


        /* CALCULA country */

  $sql = "SELECT count(web.dato13) as total,web.dato13 as name FROM form017 web where web.dato13 <> '' and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."'  and web.dato45 in (".AGENCY_ID.")  group by web.dato13 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['countryTotal']   = $res;



        /* CALCULA region */

  $sql = "SELECT count(web.dato12) as total,web.dato12 as name FROM form017 web where web.dato12 <> '' and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."'  and web.dato45 in (".AGENCY_ID.")  group by web.dato12 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['regionTotal']   = $res;



        /* CALCULA navigator */

  $sql = "SELECT count(web.dato15) as total,web.dato15 as name FROM form017 web where web.dato15 <> '' and DATE_FORMAT(web.created,'%Y-%m-%d') >= '".$desde."' and DATE_FORMAT(web.created,'%Y-%m-%d') <= '".$hasta."'  and web.dato45 in (".AGENCY_ID.")  group by web.dato15 order by 1 desc ";


      $m              = new formModel();
      $m->sql_nativo  = $sql;
      $m->internal    = true;
      $res            = $m->all();      
      $data['navigatorTotal']   = $res;


      echo json_encode($data);



}