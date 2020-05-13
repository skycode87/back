<?php

include_once('userModel.php');

$user = new userModel();

$user->firstname = 'Pedro';
$user->lastname = 'Alejandro';
$user->email = 'projas@gmail.com';
$user->save();

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