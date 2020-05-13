<?php

require_once 'Conexion.php';

class padreModelo extends conexion
{
    
    private $id;
    private $id_padre;
    private $tabla;
    private $nuevo;
    private $sql_campo;
    private $sql_valor;
    private $correlativo;
    private $numero_documento;
    private $sigla;
    public $estatu = "true";
    public $bd = "pg";
    public $motorbd = "mysql";
    public $ultimoId;
    
    public function __construct($bd = "pg")
    {
        $this->bd = $bd;
    }
    
    public function fecha_alreves($fecha)
    {
        $dd    = substr($fecha, 0, 2);
        $mm    = substr($fecha, 3, 2);
        $yy    = substr($fecha, 6, 4);
        $fecha = $yy . "/" . $mm . "/" . $dd;
        return $fecha;
    }
    
    public function vacio($var, $msj = "")
    {
        
        if (strlen($var) > 0) {
            
            return false;
        } else {
            
            if (strlen($msj) > 0) {
                echo $msj;
            }
            
            return true;
        }
    }
    
    public function novacio($var)
    {
        
        if (strlen($var) > 0)
            return true;
        else
            return false;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    }
    
    public function setConfig($tabla, $id = null)
    {
        $this->tabla = $tabla;
        $this->id    = $id;
        
        if (!$id) {
            $this->nuevo = true;
            //            $operacion = 'nuevo';
        } else {
            //            $operacion = 'editar';
        }
        //        $this->historico($this->id, $operacion);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function ejecutar_query01($query)
    {
        
        if ($this->bd == 'pg') {
            $this->abrirConexionPg();
            $this->sql = $query;
            $data      = $this->ejecutarSentenciaPg01(2);
            return $data;
        }
        
        if ($this->bd == 'mysql') {
            $this->abrirConexionMysql();
            $this->sql = $query;
            $data      = $this->ejecutarSentenciaMysql(2);
            return $data;
        }
    }
    
    public function ejecutar_query02($query)
    {
        
        $this->abrirConexionMysql();
        $this->sql = $query;
        $data      = $this->ejecutarSentenciaMysql(2);
        return $data;
    }
    
    public function ejecutar_query($sql)
    {
        
        $this->sql = $sql;
        
        if ($this->motorbd == "mysql")
            return $this->ejecutarSentenciaMysql();
        if ($this->motorbd == "pg")
            return $this->ejecutarSentenciaPg(2);
    }
    
    public function add_data($campo, $valor, $strtoupper = TRUE)
    {
        
        if ($strtoupper == 'false') {
            strlen($valor) <= 0 ? $valor = 'null , ' : $valor = "'" . $valor . "' , ";
        } else {
            strlen($valor) <= 0 ? $valor = 'null , ' : $valor = "'" . trim($strtoupper ? strtoupper(strtr($valor, "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ")) : $valor) . "', ";
        }
        
        
        if (isset($this->nuevo)) { //Nuevo Registro
            $this->sql_campo .= $campo . ',';
            $this->sql_valor .= $valor;
        } else { //Actualización de Registro
            $this->sql_valor .= $campo . " = " . $valor;
        }
    }
    
    public function add_($campo, $valor, $strtoupper = TRUE)
    {
        
        strlen($valor) <= 0 ? $valor = false : $valor = "'" . trim(pg_escape_string($strtoupper ? strtoupper(strtr($valor, "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ")) : $valor)) . "', ";
        if ($valor != false) {
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql_campo .= $campo . ',';
                $this->sql_valor .= $valor;
            } else { //Actualización de Registro
                $this->sql_valor .= $campo . " = " . $valor;
            }
        }
    }
    
    public function ejecutar($tipo_id = 'id')
    {
        
        
        
        if ($this->motorbd == "pg") {
            
            $this->abrirConexionPg();
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql = " INSERT INTO " . $this->tabla . " (" . $this->sql_campo . "registro,estatu) VALUES (" . $this->sql_valor . "'now()','" . $this->estatu . "'); ";
            } else { //Actualización de Registro
                $this->sql = "UPDATE  " . $this->tabla . "  SET  " . substr($this->sql_valor, 0, -2);
                $this->sql .= " WHERE " . $tipo_id . " in (" . $this->id . ")";
            }
            $this->ejecutarSentenciaPg(2);
            if (isset($this->nuevo)) //Nuevo Registro
                $this->id = $this->verId($this->tabla);
            unset($this->nuevo, $this->sql_campo, $this->sql_valor);
            
            $this->ultimoId = $this->verId($this->tabla);
        }
        
        
        if ($this->motorbd == "mysql") {
            
            
            $this->abrirConexionMysql();
            
            if (isset($this->nuevo)) {
                $this->sql_valor = substr(trim($this->sql_valor), 0, -1);
                $this->sql_campo = substr(trim($this->sql_campo), 0, -1);
            }
            
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql = " INSERT INTO " . $this->tabla . " (" . $this->sql_campo . ") VALUES (" . $this->sql_valor . "); ";
            } else { //Actualización de Registro
                $this->sql = "UPDATE  " . $this->tabla . "  SET  " . substr($this->sql_valor, 0, -2);
                $this->sql .= " WHERE " . $tipo_id . " in (" . $this->id . ")";
            }
            $this->ejecutarSentenciaMysql();
            if (isset($this->nuevo)) //Nuevo Registro
                $this->id = $this->verIdMysql();
            unset($this->nuevo, $this->sql_campo, $this->sql_valor);
            
            $this->ultimoId = $this->verIdMysql();
        }
    }
    
    public function _update_sql($sql)
    {
        
        
        if ($this->motorbd == "pg") {
            
            $this->abrirConexionPg();
            $this->sql = $sql;
            $this->ejecutarSentenciaPg(2);
            $this->id       = $this->verId($this->tabla);
            $this->ultimoId = $this->verId($this->tabla);
        }
        
        
        if ($this->motorbd == "mysql") {
            
            $this->abrirConexionMysql();
            $this->sql = $sql;
            $this->ejecutarSentenciaMysql();
            $this->id       = $this->verIdMysql();
            $this->ultimoId = $this->verIdMysql();
        }
    }
    
    public function get_ultimoId($tabla)
    {
        
        if ($this->motorbd == "mysql")
            return $this->verIdMysql();
        if ($this->motorbd == "pg")
            return $this->verIdPg($tabla);
    }
    
    public function verId($tabla)
    {
        
        if ($this->motorbd == "mysql")
            $this->verIdMysql();
        if ($this->motorbd == "pg")
            $this->verIdPg($tabla);
    }
    
    /**
     * Consulta la siguiente id de una tabla, tomada de la secuencia.
     */
    public function proxId($tabla)
    {
        $this->abrirConexionPg();
        $this->sql = "SELECT MAX(id)+1 as id FROM " . $tabla;
        $data      = $this->ejecutarSentenciaPg(2);
        return $data[0]['id'];
    }
    
    public function ver_todo($condicion = false)
    {
        
        $this->abrirConexionPg();
        
        if (!$condicion) {
            $this->sql = "select  *  from " . $this->tabla . " where estatu=true ;";
        } else {
            $this->sql = "select  *  from " . $this->tabla . " where estatu=true " . $condicion . " ;";
        }
        
        $data = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    public function ver_vista($vista, $condicion = '1=1')
    {
        $this->abrirConexionPg();
        $this->sql = "select  *  from " . $vista . " where  " . $condicion . ";";
        $data      = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    
    
    public function ver_uno($id, $campo = '')
    {
        $this->abrirConexionPg();
        if ($campo)
            $this->sql = "select  *  from " . $this->tabla . " where " . $campo . "='" . $id . "' and estatu=true";
        else
            $this->sql = "select  *  from " . $this->tabla . " where id='" . $id . "' and estatu=true";
        $data = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    
    
    public function actualizar($tabla, $id, $campo, $valor)
    {
        $this->abrirConexionPg();
        $this->sql = "UPDATE  $tabla SET $campo='$valor'  WHERE id=$id";
        $data      = $this->ejecutarSentenciaPg();
    }
    
    
    
    public function eliminar($campo = 'id', $tabla = FALSE)
    {
        $this->abrirConexionPg();
        if ($tabla)
            $this->tabla = $tabla;
        $this->sql = "UPDATE " . $this->tabla . " SET  estatu='FALSE'  WHERE $campo ='" . $_SESSION['id_eliminacion'] . "';";
        $data      = $this->ejecutarSentenciaPg();
        #$this->historico($_SESSION['id_eliminacion'], 'eliminar'); OJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        return $data;
    }
    
    
    
    public function alertas($msj)
    {
        echo "<script>alert('" . $msj . "') </script>";
    }
    
    public function encrypt($string)
    {
        /* $key = "lsdrojas@cluuf.com";
        $result = '';
        $string = base64_encode($string);
        for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result.=$char;
        return base64_encode($string);
        
        } */
        return base64_encode($string);
    }
    
    public function decrypt($string)
    {
        /* $key = "lsdrojas@cluuf.com";
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result.=$char;
        }
        return $result;
        */
        
        return base64_decode($string);
    }
    
    
    
    public function date_now()
    {
        return date('Y/m/d H:i:s');
    }
    
    
    
    
    
}

$objeto = new padreModelo();
?>