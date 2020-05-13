<?php
include_once "../main/common.php";
include_once "web.php";


function webByAgency($AGENCY__){


      /*  $sql = " SELECT distinct root.id AS 'root', root.dato01 AS 'root_name' FROM form020 web join form020 root on root.id = web.dato41 WHERE web.dato40 IN ( '".$AGENCY__."' )  and web.dato41 > 1 AND web.archived = 'no' and root.dato12 <> '1' ";*/

  $sql = " SELECT distinct web.id AS 'root', web.dato01 AS 'root_name' FROM form020 web  WHERE web.dato40 IN ( '".$AGENCY__."' )  and web.dato41 > 1 AND web.archived = 'no'   ";

        $m = new formModel();
        $m->sql_nativo = $sql;
        $m->internal = true;
        $res = $m->all();   

        for($i=0;$i<count($res);$i++){


					 $sql2 = "
					        SELECT 
					       web.dato01    AS 'web_name', 
					       web.dato02    AS 'web_value', 
					       web.dato03    AS 'web_category', 
					       web.dato04    AS 'web_order', 
					       web.dato10    AS 'web_section', 
					       web.created   AS 'web_created', 
					       web.code      AS 'web_code', 
					       web.token     AS 'web_token', 
					       web.id        AS 'web_id', 
					       web.dato06    AS 'web_url', 
					       web.dato07    AS 'web_title', 
					       web.dato08    AS 'web_subtitle', 
					       web.dato09    AS 'web_url_title', 
					       web.dato04    AS 'web_order',
					       web.dato11    AS 'web_icon',
					       web.dato10    AS 'web_type',
					       web.dato31    AS 'web_content'

 						   FROM  form020 web WHERE  web.dato40 IN ( '".$AGENCY__."' ) 
 						   and web.dato41 IN ('".$res[$i]['root']."') AND web.archived = 'no' and web.dato12 = 1 order by web.dato41 ASC, web.dato04 ASC ";

			        $m = new formModel();
			        $m->sql_nativo = $sql2;
			        $m->internal = true;
			        $res2 = $m->all();   

			        for($z=0;$z<count($res2);$z++){

			        


			        		//if($res2[$z]['web_type']==4){

			        		
			        		/*	if($res[$i]['root_name']=='link'){

		     						$data[$res[$i]['root_name']][$z]['url'] =$res2[$z]['web_url'];
						        	$data[$res[$i]['root_name']][$z]['url_title']=$res2[$z]['web_url_title'];


			        			}else if($res[$i]['root_name']=='titles'){


									$data[$res[$i]['root_name']][$z]['name'] =$res2[$z]['web_title'];
						        	$data[$res[$i]['root_name']][$z]['value']=$res2[$z]['web_subtitle'];


			        			}else if($res[$i]['root_name']=='cta'){


									$data[$res[$i]['root_name']][$z]['url_title'] =$res2[$z]['web_url_title'];
						        	$data[$res[$i]['root_name']][$z]['url']=$res2[$z]['web_url'];
						        	$data[$res[$i]['root_name']][$z]['name']=$res2[$z]['web_name'];


			        			} else {
								
*/


			        				if($res2[$z]['web_order']!="")
									$data[$res[$i]['root_name']][$z]['index']=$res2[$z]['web_order'];
						        	
						        	if($res2[$z]['web_value']!="")
						        	$data[$res[$i]['root_name']][$z]['name']=$res2[$z]['web_value'];

						            if($res2[$z]['web_url']!="")
						        	$data[$res[$i]['root_name']][$z]['url'] =$res2[$z]['web_url'];

						            if($res2[$z]['web_title']!="")
						        	$data[$res[$i]['root_name']][$z]['title']=$res2[$z]['web_title'];

						        	if($res2[$z]['web_subtitle']!="")
						        	$data[$res[$i]['root_name']][$z]['subtitle']=$res2[$z]['web_subtitle'];

						            if($res2[$z]['web_url_title']!="")
						        	$data[$res[$i]['root_name']][$z]['url_title']=$res2[$z]['web_url_title'];

						            if($res2[$z]['web_url_title']!="")
						        	$data[$res[$i]['root_name']][$z]['url_title']=$res2[$z]['web_url_title'];

						            if($res2[$z]['web_icon']!="")
						        	$data[$res[$i]['root_name']][$z]['icon']=$res2[$z]['web_icon'];

						            if($res2[$z]['web_name']!="")
						        	$data[$res[$i]['root_name']][$z]['value']=$res2[$z]['web_name'];

						            if($res2[$z]['web_content']!="")
						        	$data[$res[$i]['root_name']][$z]['content']=$res2[$z]['web_content'];

						            if($res2[$z]['web_category']!="")
						        	$data[$res[$i]['root_name']][$z]['category']=$res2[$z]['web_category'];




			        			//}


			        		


			        		//}
 							
 							/*if($res2[$z]['web_type']<4){

 								$data[$res[$i]['root_name']][$res2[$z]['web_name']]=$res2[$z]['web_value'];

			        		}*/
			        	

			        	

			        }







        }

        return $data;    

     }




if(($method==='GET')){
  
	$agencyID 	   = objectID(_agency_,$action);
    $database = webByAgency($agencyID);
    echo json_encode($database);
    return 0;
    exit;
}


?>