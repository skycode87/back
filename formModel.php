<?php
    require_once 'Conexion.php';
class formModel extends Conexion{

public $table         = "form001"; 
public $request       = "";

public $id = null;
public $id_field = "id"; 

public $user = null;
public $user_field = "user"; 

public $server = null;
public $server_field = "server"; 

public $archived = null;
public $archived_field = "archived"; 

public $created = null;
public $created_field = "created"; 

public $updated = null;
public $updated_field = "updated"; 

public $code = null;
public $code_field = "code"; 

public $token = null;
public $token_field = "token"; 

public $link = null;
public $link_field = "link"; 


public $access = null;
public $access_field = "token"; 

public $dato01 = null;
public $dato01_field = "dato01"; 

public $dato02 = null;
public $dato02_field = "dato02"; 

public $dato03 = null;
public $dato03_field = "dato03"; 

public $dato04 = null;
public $dato04_field = "dato04"; 

public $dato05 = null;
public $dato05_field = "dato05"; 

public $dato06 = null;
public $dato06_field = "dato06"; 

public $dato07 = null;
public $dato07_field = "dato07"; 

public $dato08 = null;
public $dato08_field = "dato08"; 

public $dato09 = null;
public $dato09_field = "dato09"; 

public $dato10 = null;
public $dato10_field = "dato10"; 

public $dato11 = null;
public $dato11_field = "dato11"; 

public $dato12 = null;
public $dato12_field = "dato12"; 

public $dato13 = null;
public $dato13_field = "dato13"; 

public $dato14 = null;
public $dato14_field = "dato14"; 

public $dato15 = null;
public $dato15_field = "dato15"; 

public $dato16 = null;
public $dato16_field = "dato16"; 

public $dato17 = null;
public $dato17_field = "dato17"; 

public $dato18 = null;
public $dato18_field = "dato18"; 

public $dato19 = null;
public $dato19_field = "dato19"; 

public $dato20 = null;
public $dato20_field = "dato20"; 

public $dato21 = null;
public $dato21_field = "dato21"; 

public $dato22 = null;
public $dato22_field = "dato22"; 

public $dato23 = null;
public $dato23_field = "dato23"; 

public $dato24 = null;
public $dato24_field = "dato24"; 

public $dato25 = null;
public $dato25_field = "dato25"; 

public $dato26 = null;
public $dato26_field = "dato26"; 

public $dato27 = null;
public $dato27_field = "dato27"; 

public $dato28 = null;
public $dato28_field = "dato28"; 

public $dato29 = null;
public $dato29_field = "dato29"; 

public $dato30 = null;
public $dato30_field = "dato30"; 

public $dato31 = null;
public $dato31_field = "dato31"; 

public $dato32 = null;
public $dato32_field = "dato32"; 

public $dato33 = null;
public $dato33_field = "dato33"; 

public $dato34 = null;
public $dato34_field = "dato34"; 

public $dato35 = null;
public $dato35_field = "dato35"; 

public $dato36 = null;
public $dato36_field = "dato36"; 

public $dato37 = null;
public $dato37_field = "dato37"; 

public $dato38 = null;
public $dato38_field = "dato38"; 

public $dato39 = null;
public $dato39_field = "dato39"; 

public $dato40 = null;
public $dato40_field = "dato40"; 

public $dato41 = null;
public $dato41_field = "dato41"; 

public $dato42 = null;
public $dato42_field = "dato42"; 

public $dato43 = null;
public $dato43_field = "dato43"; 

public $dato44 = null;
public $dato44_field = "dato44"; 

public $dato45 = null;
public $dato45_field = "dato45"; 

public $dato46 = null;
public $dato46_field = "dato46"; 

public $dato47 = null;
public $dato47_field = "dato47"; 

public $dato48 = null;
public $dato48_field = "dato48"; 

public $dato49 = null;
public $dato49_field = "dato49"; 

public $dato50 = null;
public $dato50_field = "dato50"; 




public function esqueleto(){ 


if( $this->user !== null ){ 
$this->where_value__[] = $this->user;
$this->where_field__[] = $this->user_field;
  }

if( $this->server !== null ){ 
$this->where_value__[] = $this->server;
$this->where_field__[] = $this->server_field;
  }

if( $this->archived !== null ){ 
$this->where_value__[] = $this->archived;
$this->where_field__[] = $this->archived_field;
  }

if( $this->created !== null ){ 
$this->where_value__[] = $this->created;
$this->where_field__[] = $this->created_field;
  }

if( $this->updated !== null ){ 
$this->where_value__[] = $this->updated;
$this->where_field__[] = $this->updated_field;
  }

if( $this->code !== null ){ 
    $this->where_value__[] = $this->code;
    $this->where_field__[] = $this->code_field;
  }


if( $this->access !== null ){ 
    $this->where_value__[] = $this->access;
    $this->where_field__[] = $this->access_field;
  }


if( $this->token !== null ){ 
    $this->where_value__[] = $this->token;
    $this->where_field__[] = $this->token_field;
  }

if( $this->link !== null ){ 
    $this->where_value__[] = $this->link;
    $this->where_field__[] = $this->link_field;
  }

if( $this->dato01 !== null ){ 
$this->where_value__[] = $this->dato01;
$this->where_field__[] = $this->dato01_field;
  }

if( $this->dato02 !== null ){ 
$this->where_value__[] = $this->dato02;
$this->where_field__[] = $this->dato02_field;
  }

if( $this->dato03 !== null ){ 
$this->where_value__[] = $this->dato03;
$this->where_field__[] = $this->dato03_field;
  }

if( $this->dato04 !== null ){ 
$this->where_value__[] = $this->dato04;
$this->where_field__[] = $this->dato04_field;
  }

if( $this->dato05 !== null ){ 
$this->where_value__[] = $this->dato05;
$this->where_field__[] = $this->dato05_field;
  }

if( $this->dato06 !== null ){ 
$this->where_value__[] = $this->dato06;
$this->where_field__[] = $this->dato06_field;
  }

if( $this->dato07 !== null ){ 
$this->where_value__[] = $this->dato07;
$this->where_field__[] = $this->dato07_field;
  }

if( $this->dato08 !== null ){ 
$this->where_value__[] = $this->dato08;
$this->where_field__[] = $this->dato08_field;
  }

if( $this->dato09 !== null ){ 
$this->where_value__[] = $this->dato09;
$this->where_field__[] = $this->dato09_field;
  }

if( $this->dato10 !== null ){ 
$this->where_value__[] = $this->dato10;
$this->where_field__[] = $this->dato10_field;
  }

if( $this->dato11 !== null ){ 
$this->where_value__[] = $this->dato11;
$this->where_field__[] = $this->dato11_field;
  }

if( $this->dato12 !== null ){ 
$this->where_value__[] = $this->dato12;
$this->where_field__[] = $this->dato12_field;
  }

if( $this->dato13 !== null ){ 
$this->where_value__[] = $this->dato13;
$this->where_field__[] = $this->dato13_field;
  }

if( $this->dato14 !== null ){ 
$this->where_value__[] = $this->dato14;
$this->where_field__[] = $this->dato14_field;
  }

if( $this->dato15 !== null ){ 
$this->where_value__[] = $this->dato15;
$this->where_field__[] = $this->dato15_field;
  }

if( $this->dato16 !== null ){ 
$this->where_value__[] = $this->dato16;
$this->where_field__[] = $this->dato16_field;
  }

if( $this->dato17 !== null ){ 
$this->where_value__[] = $this->dato17;
$this->where_field__[] = $this->dato17_field;
  }

if( $this->dato18 !== null ){ 
$this->where_value__[] = $this->dato18;
$this->where_field__[] = $this->dato18_field;
  }

if( $this->dato19 !== null ){ 
$this->where_value__[] = $this->dato19;
$this->where_field__[] = $this->dato19_field;
  }

if( $this->dato20 !== null ){ 
$this->where_value__[] = $this->dato20;
$this->where_field__[] = $this->dato20_field;
  }

if( $this->dato21 !== null ){ 
$this->where_value__[] = $this->dato21;
$this->where_field__[] = $this->dato21_field;
  }

if( $this->dato22 !== null ){ 
$this->where_value__[] = $this->dato22;
$this->where_field__[] = $this->dato22_field;
  }

if( $this->dato23 !== null ){ 
$this->where_value__[] = $this->dato23;
$this->where_field__[] = $this->dato23_field;
  }

if( $this->dato24 !== null ){ 
$this->where_value__[] = $this->dato24;
$this->where_field__[] = $this->dato24_field;
  }

if( $this->dato25 !== null ){ 
$this->where_value__[] = $this->dato25;
$this->where_field__[] = $this->dato25_field;
  }

if( $this->dato26 !== null ){ 
$this->where_value__[] = $this->dato26;
$this->where_field__[] = $this->dato26_field;
  }

if( $this->dato27 !== null ){ 
$this->where_value__[] = $this->dato27;
$this->where_field__[] = $this->dato27_field;
  }

if( $this->dato28 !== null ){ 
$this->where_value__[] = $this->dato28;
$this->where_field__[] = $this->dato28_field;
  }

if( $this->dato29 !== null ){ 
$this->where_value__[] = $this->dato29;
$this->where_field__[] = $this->dato29_field;
  }

if( $this->dato30 !== null ){ 
$this->where_value__[] = $this->dato30;
$this->where_field__[] = $this->dato30_field;
  }

if( $this->dato31 !== null ){ 
$this->where_value__[] = $this->dato31;
$this->where_field__[] = $this->dato31_field;
  }

if( $this->dato32 !== null ){ 
$this->where_value__[] = $this->dato32;
$this->where_field__[] = $this->dato32_field;
  }

if( $this->dato33 !== null ){ 
$this->where_value__[] = $this->dato33;
$this->where_field__[] = $this->dato33_field;
  }

if( $this->dato34 !== null ){ 
$this->where_value__[] = $this->dato34;
$this->where_field__[] = $this->dato34_field;
  }

if( $this->dato35 !== null ){ 
$this->where_value__[] = $this->dato35;
$this->where_field__[] = $this->dato35_field;
  }

if( $this->dato36 !== null ){ 
$this->where_value__[] = $this->dato36;
$this->where_field__[] = $this->dato36_field;
  }

if( $this->dato37 !== null ){ 
$this->where_value__[] = $this->dato37;
$this->where_field__[] = $this->dato37_field;
  }

if( $this->dato38 !== null ){ 
$this->where_value__[] = $this->dato38;
$this->where_field__[] = $this->dato38_field;
  }

if( $this->dato39 !== null ){ 
$this->where_value__[] = $this->dato39;
$this->where_field__[] = $this->dato39_field;
  }

if( $this->dato40 !== null ){ 
$this->where_value__[] = $this->dato40;
$this->where_field__[] = $this->dato40_field;
  }

if( $this->dato41 !== null ){ 
$this->where_value__[] = $this->dato41;
$this->where_field__[] = $this->dato41_field;
  }

if( $this->dato42 !== null ){ 
$this->where_value__[] = $this->dato42;
$this->where_field__[] = $this->dato42_field;
  }

if( $this->dato43 !== null ){ 
$this->where_value__[] = $this->dato43;
$this->where_field__[] = $this->dato43_field;
  }

if( $this->dato44 !== null ){ 
$this->where_value__[] = $this->dato44;
$this->where_field__[] = $this->dato44_field;
  }

if( $this->dato45 !== null ){ 
$this->where_value__[] = $this->dato45;
$this->where_field__[] = $this->dato45_field;
  }

if( $this->dato46 !== null ){ 
$this->where_value__[] = $this->dato46;
$this->where_field__[] = $this->dato46_field;
  }

if( $this->dato47 !== null ){ 
$this->where_value__[] = $this->dato47;
$this->where_field__[] = $this->dato47_field;
  }

if( $this->dato48 !== null ){ 
$this->where_value__[] = $this->dato48;
$this->where_field__[] = $this->dato48_field;
  }

if( $this->dato49 !== null ){ 
$this->where_value__[] = $this->dato49;
$this->where_field__[] = $this->dato49_field;
  }

if( $this->dato50 !== null ){ 
$this->where_value__[] = $this->dato50;
$this->where_field__[] = $this->dato50_field;
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


