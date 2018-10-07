<?php
    require '../db/db.php';
    require 'wsUtils.php';
    $db = new db();
    $ws = new wsUtils();
    
    header('Content-type: text/json');
    
    $ws->response(1, "Sucesso ao puxar peguntas", 
            $db->select("perguntas", array("*", "concat(\"http://www.esqi.esy.es/uploads/\", foto) as fotoPath"))
                    );
    