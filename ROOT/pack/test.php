<?php
include_once "../main/common.php";
include_once "pack.php";
include_once "app.php";





  
  	/*
        $m             = new formModel();
        $m->sql_nativo =   "select id from form001 where archived='no' ";
        $m->internal   = true;
        $planes           = $m->all();

        for ($i = 0; $i < count($planes); $i++){

        	    $sql = "select count(plan.id) as 'total', plan.id  as 'id' from form001 plan join form005 app on app.dato41 = plan.id and app.archived='no' and plan.archived= 'no' and plan.id in (".$planes[$i]['id'].") group by plan.id order by 1 desc ";

		 		$m             = new formModel();
		        $m->sql_nativo = $sql;
		        $m->internal   = true;
		        $res1          = $m->all();

		        if($res1[0]['id']){
		        	// echo $res1[0]['id']." / ".$res1[0]['total']."<br>";
		        	}else{

                $m              = new formModel();
                $m->table 		= 'form001';
                $m->archived    = 'yes';
                $e = $m->updated($planes[$i]['id']);

                echo $e;

		        }		       

        }




/*
        $m             = new formModel();
        $m->sql_nativo =   "select id,dato42 from form005 where archived='yes' ";
        $m->internal   = true;
        $apps           = $m->all();

        for ($i = 0; $i < count($apps); $i++){


        		 $m             = new formModel();
        		 $m->sql_nativo =   "select dato01,dato04,created from form006 where id in (".$apps[$i]['dato42'].")";
        		 $m->internal   = true;
                 $user           = $m->all();
        	     echo $user[0]['dato01']."/".$user[0]['dato04']." ".$user[0]['created']."<br>";
		     
                  $m              = new formModel();
                  $m->table 		= 'form006';
                  $m->archived    = 'yes';
                  $e = $m->updated($apps[$i]['dato42']);
                  echo $e;

		       	       

        }

*/


/*
 $appId = '2108';
 $app__ =  single(_app_,'app',$appId,'null','app_token',$APP,1);
 print_r($app__);
*/




/*


        $ch = curl_init("www.example.com/curl.php?option=test");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch);
        echo $output;

*/


//appData($id,$alcance,$tipo,$select,$extra);



//$select = "  app.token AS 'app_token' ";
//$res = appData('555','plan','plan','single');
//print_r($res);

?>

