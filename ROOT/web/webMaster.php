<?php
include_once "../main/common.php";
include_once "web.php";


function webMaster($web, $WHERE = "1=1")
{
    
    $sql = " SELECT ";
    
    if ($WHERE == 'all') {
        $WHERE = ' 1=1 ';
    }
    
    
    foreach ($web as $key => $value) {
        $sql = $sql . " " . $value . " AS " . $key . ",";
    }
    
        
    
    $sql .= " '' as '' FROM  form020 web WHERE web.dato45 in (".$_SESSION['AGENCY_ID'].")  and " . $WHERE . " and web.archived = 'no' ";
    $m             = new formModel();
    $m->sql_nativo = $sql;
    $m->internal   = true;
    $res           = $m->all();
    return $res;
    
}

function webCategory()
{
    
    $sql           = " SELECT dato03 as 'web_category' FROM  form020 web WHERE web.dato45 in (".$_SESSION['AGENCY_ID'].")  and web.archived = 'no'  group by  web.dato03 order by 1 asc  ";

    $m             = new formModel();
    $m->sql_nativo = $sql;
    $m->internal   = true;
    $res           = $m->all();
    return $res;
}




function webRoot()
{
    
    $sql           = " SELECT  dato01 as 'web_name',  dato02 as 'web_value', id as 'web_id' , token as 'web_token' FROM  form020 web WHERE web.dato45 in (".$_SESSION['AGENCY_ID'].") and web.dato10 in (1) and web.archived = 'no' order by 1 asc  ";
    $m             = new formModel();
    $m->sql_nativo = $sql;
    $m->internal   = true;
    $res           = $m->all();
    return $res;
}


   $WEB['web_mode']         =  "dato12";
   $WEB['web_name']             =  "dato01";
   $WEB['web_value']            =  "dato02";
   $WEB['web_category']       =  "dato03";
   $WEB['web_order']            =  "dato04";
   $WEB['web_description']  =  "dato05";
   $WEB['web_url']          =  "dato06";
   $WEB['web_title']        =  "dato07";
   $WEB['web_subtitle'] =  "dato08";
   $WEB['web_content']  =  "dato31";
   $WEB['web_url_title']=  "dato09";
   $WEB['web_icon']         =  "dato11";
   $WEB['web_visible']  =  "dato12";
   $WEB['web_type']         =  "dato10";
   $WEB['web_root']         =  "dato41";
   $WEB['web_token']        =  "token";
   $WEB['web_id']       =  "id";



if ($request[0] == 'search') {
    
    $where = " ( web.dato07 like '%".$request[1]."%' OR";
    $where.= " web.dato08 like '%".$request[1]."%' OR";
    $where.= " web.dato05 like '%".$request[1]."%' OR";
    $where.= " web.dato01 like '%".$request[1]."%' )";

    $database['web'] =  master(_web_,'web','null','null',$WEB,AGENCY_ID,$where);
    echo json_encode($database);
    exit;

    
}else if ($request[0] == 'link') {
    
    
    
} else if ($request[0] == 'root') {
    
    if ((!$request[1]) || ($request[1] == 'all')) {
        $database['web'] = webMaster($WEB, "all");
    } else {
        $database['web'] = webMaster($WEB," web.dato41 in ('" . $request[1] . "')  ");
    }
    
}

//$database['category'] = webCategory();
$database['root']     = webRoot();
echo json_encode($database);
return 0;
exit;
