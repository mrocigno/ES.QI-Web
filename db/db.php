<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author Matheus
 */
class db {
    private $con;
    
    function connect(){
        $this->con = mysqli_connect('mysql.hostinger.com.br','u936003305_esqi','MadrinhA!!1');
        mysqli_select_db($this->con,'u936003305_esqi');
        
    }
    
    public function insert($table, $array){
        if(!isset($this->con)){
            $this->connect();
        }

        $campos = "";
        $valores = "";
        foreach ($array as $key => $value) {
            $campos .= $key . ", ";
            $valores .=  "'$value', ";
        }
        
        $campos = substr($campos, 0, strlen($campos)-2);
        $valores = substr($valores, 0, strlen($valores)-2);
        
        $sql = "INSERT INTO $table ($campos) VALUES ($valores)";
        mysqli_query($this->con, $sql);
        
        $result = mysqli_query($this->con, "SELECT LAST_INSERT_ID() AS lid;");
        mysqli_close($this->con);
        if($linha = mysqli_fetch_array($result)){
            return $linha["lid"];
        }else{
            return 0;
        }
    }
    
    public function select($table, $arrayCampos, $arrayWhere = null, $arrayLimit = null){
        if(!isset($this->con)){
            $this->connect();
        }

        $campos = "";
        foreach ($arrayCampos as $key => $value) {
            $campos .= $value . ", ";
        }
        $campos = substr($campos, 0, strlen($campos)-2);
        
        $where = "";
        if(isset($arrayWhere)){
            foreach ($arrayWhere as $key => $value) {
                
                $where .= $key . " = ". (is_numeric($value)? $value:"'$value'") . " AND";
            }
            $where = " WHERE " . substr($where, 0, strlen($where)-4);
        }
        
        $limit = "";
        if(isset($arrayLimit) && $arrayLimit != ""){
            if(isset($arrayLimit["page"]) && isset($arrayLimit["limit"])){
                $limit = " LIMIT " . (($arrayLimit["limit"] * $arrayLimit["page"]) - $arrayLimit["limit"]) . ", " . $arrayLimit["limit"];
            }
        }

        $sql = "SELECT $campos FROM $table$where$limit";

        $result = mysqli_query($this->con, $sql);
        
        $retorno = array();
        
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($retorno, $linha);
        }
        mysqli_close($this->con);
        
        return $retorno;
    }
}
