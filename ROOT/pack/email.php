<?php

        $EMAIL["email_subject"] 			 = "dato01";
        $EMAIL["email_body"]				 = "dato02";
        $EMAIL["email_email"]			     = "dato03";
        $EMAIL['email_response']             = "dato04";
        $EMAIL['email_code']                 = "dato05";        
        $EMAIL["email_status"]               = "dato10";        
        $EMAIL["email_id"]				     = "id";
        $EMAIL['email_created']              = "created";
        $EMAIL['email_app_id']               = "dato40";



        function newEmail($subject,$body,$email,$status,$response,$code,$appId){

                     if(!isset($_SESSION['AGENT_ID'])){
                        $user = 0;
                     }else{
                        $user = $_SESSION['AGENT_ID']; 
                     }   

                    $m            = new formModel();
                    $m->table     = 'form022';
                    $m->archived  = 'no';
                    $m->dato01    = $subject;
                    $m->dato03    = $email;
                    $m->user      = $user;
                    $m->dato04    = $body;
                    $m->dato05    = $code;
                    $m->dato10    = $status;
                    $m->dato40    = $appId;
                    $m->dato45    = $_SESSION['AGENCY_ID'];
                    $m->created   = $m->now__();
                    $id           = $m->save();

        }





?>