<?php

include_once('userModel.php');

$user = new userModel();

$user->firstname = 'deos';
$user->lastname = 'garcia';
$user->email = 'xcvbnm@gmail.com';
$user->save(1);

$res = $user->all();

echo $res;


/*
for ($i=0; $i < ; $i++) { 
 
    echo "
        if( \$this->".$var." !== null ){ <br> &nbsp;&nbsp;&nbsp;
            \$this->where_value__[] = \$this->".$var."; <br> &nbsp;&nbsp;&nbsp;
            \$this->where_field__[] = \$this->".$var."_field; <br>
        }; <br>
        "
}



?>



<?
//$var = 'access';


/*
for ($i=0; $i < ; $i++) { 
 
    echo "
        if( \$this->".$var." !== null ){ <br> &nbsp;&nbsp;&nbsp;
            \$this->where_value__[] = \$this->".$var."; <br> &nbsp;&nbsp;&nbsp;
            \$this->where_field__[] = \$this->".$var."_field; <br>
        }; <br>
        "

}
*/

?>