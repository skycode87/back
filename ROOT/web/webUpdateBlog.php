<?php
include_once "../main/common.php";
include_once "blog.php";


if(($method==='POST')&&(AGENCY_ID)){

	    UsageAPI('webUpdateBlog',AGENCY_ID,AGENT_ID,AGENT_NAME);
	
		$blogId 	   = objectID(_blog_,TOKEN_OBJECT,AGENCY_ID);

	
	   	if($blogId){



	   	if($_POST['blog_type']==0){

				$_POST['blog_type']=0;

		}else if($_POST['blog_schedule']){

				$hoy  =  strtotime(date("Y-m-d"));
		        $fecha = strtotime($_POST['blog_schedule']);			

				if($fecha <=  $hoy ){
					$_POST['blog_type'] = BLOG_VISIBLE;	
				}

				if($fecha >  $hoy ) {
					$_POST['blog_type'] = BLOG_SCHEDULE;	
				}

		}else{

			if($_POST['blog_type']>0){
				$_POST['blog_schedule']  =  date("Y-m-d");
			}else{
				$_POST['blog_type']=0;
			}
	
		}		

		






			        $m = new formModel();
			        $m->table   	= _blog_;
					$m->dato02      = trim($_POST['blog_title']); /* nombre */
					$m->dato03     	= trim($_POST['blog_summary']); 
					$m->dato04     	= trim($_POST['blog_autor']); 
					$m->dato05     	= trim($_POST['blog_category']); 
					$m->dato06     	= trim(strtolower($_POST['blog_url']));; 
					$m->dato07     	= trim($_POST['blog_meta']); 
					$m->dato08     	= trim($_POST['blog_tags']); 
					$m->dato10     	= $_POST['blog_type']; 
					$m->dato32    	= trim($_POST['web_icon']); 
					$m->dato09     	= trim($_POST['blog_schedule']); 
					$m->archived   	= 'no'; 
					$m->dato40     	= 1; 
					$m->dato41     	= 1; 
				    $m->dato45 	    = AGENCY_ID;
					$m->updated     = $m->now__();
					$m->updated($blogId);
			 	    updateServer('https://lospatioshb.com/cluuf/blog/loadData.php?token='.TOKEN_OBJECT);

	   	}else{
			notify('Error en webUpdateBlog :'.AGENCY_ID);
	   	}

}

?>


