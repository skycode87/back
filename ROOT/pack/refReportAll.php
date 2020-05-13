<?php
include_once "comun.php";


if($AGENCY__){

       $sql = "SELECT 

        ref.dato01      AS 'ref_fullname',
        ref.dato02      AS 'ref_email',
        ref.dato03      AS 'ref_phone',
        ref.token       AS 'ref_token'

FROM   form008 ref 
WHERE  ref.dato45 in ('".$AGENCY__."') 
       AND ref.archived    = 'no'
       Order By  ref.dato01  asc";

      $m = new formModel();
      $m->sql_nativo = $sql;
      echo  $m->all();      

}