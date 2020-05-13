<?php
    require_once 'Conexion.php';

class userModel extends conexion{


public $table         = "user"; 
public $request       = "";

public $id = null;
public $id_field = "id";

public $firstname = null;
public $firstname_field = "firstname"; 

public $lastname = null;
public $lastname_field = "lastname"; 


public $email = null;
public $email_field = "email"; 



public function ok(){
  echo 'okkkk';
}

public function esqueleto(){ 


if( $this->id !== null ){ 
      $this->where_value__[] = $this->id;
      $this->where_field__[] = $this->id_field;
  }

if( $this->firstname !== null ){ 
      $this->where_value__[] = $this->firstname;
      $this->where_field__[] = $this->firstname_field;
  }

if( $this->lastname !== null ){ 
      $this->where_value__[] = $this->lastname;
      $this->where_field__[] = $this->lastname_field;
  }

if( $this->email !== null ){ 
      $this->where_value__[] = $this->email;
      $this->where_field__[] = $this->email_field;
  }


}


public function save($id=null)
    {
        $this->id = $id;

        $this->esqueleto();

        return $this->ejecucion();
    }



public function updated($id)
    {
      if($id>0){
        $this->id = $id;
        $this->esqueleto();
        return $this->ejecucion();
      }else{
        return $this->error; 
      }
        
    }


  public function __destruct() {
    }

}


