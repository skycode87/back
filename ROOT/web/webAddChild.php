<?php
include_once "../main/common.php";
include_once "web.php";


if(($method==='POST')&&(AGENCY_ID)){

	/*


INSERT INTO `form020` (`id`, `user`, `server`, `archived`, `created`, `updated`, `code`, `token`, `link`, `dato01`, `dato02`, `dato03`, `dato04`, `dato05`, `dato06`, `dato07`, `dato08`, `dato09`, `dato10`, `dato11`, `dato12`, `dato13`, `dato14`, `dato31`, `dato32`, `dato33`, `dato40`, `dato45`, `dato42`, `dato41`) VALUES (NULL, '2', '', 'no', '2019-12-26 15:55:47', '2019-12-26 15:55:47', 'ZGGLO70A6M', 'DQQUKOGDBYHSEV7MRT5Y1WCZPI2ZMFR49C3WIJTNPBEU8LHJLSMCKGBVXYFUSIFEBZWQHU6CYIXRSNPDOVZ5LO8ANEKH01TPLQG2', '2NJMCIZRWEY3IZYAHWDPTC4GJ8FXUDO1USREMG0LTBQKSOAHQ7SCAAM3DPT5ZNRXOFJJQU1BIYEG6VZW9MOTUDCGXRS2IFYNL4LH', 'roots', 'All roots of the website for Edit or Remove', 'ROOT', '', '', '', '', '', '', '5', '', '', '', '', '', '', '', '4', '4', '0', '158')

	*/

				$m 				= new formModel();
				$m->table  		= _web_;
				$m->archived	= 'no';
				$m->created 	= $m->now__();
				$m->updated 	= $m->now__();
				$m->user    	= AGENT_ID;
				$m->code     	= createCode(_web_);
				$m->token   	= createToken(_web_);
				$m->link   	    = createLink(_web_);		
				$m->dato01     	= trim(strtolower($_POST['web_name'])); 
				$m->dato07     	= trim($_POST['web_title']); 
				$m->dato05     	= trim($_POST['web_description']); 
				$m->dato08     	= trim($_POST['web_subtitle']); 
				$m->dato41     	= $_POST['web_root']; 
			    $m->dato09 	    = $_POST['web_url_title'];
			    $m->dato06 	    = $_POST['web_url'];
			    $m->dato11 	    = $_POST['web_icon'];
			    $m->dato45 	    = AGENCY_ID;
			    $m->dato03 	    = addCategory(AGENCY_ID,$_POST['web_root']);
			    $m->dato04 	    = $_POST['web_order'];
			    $m->dato10 	    = WEB_TYPE_CHILD;
			    $m->dato40 	    = AGENCY_ID;
	    		$m->save();

   
    	ok();
	}
    exit;


?>