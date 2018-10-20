<?php
    require '../db/db.php';
    require '../ws/wsUtils.php';
    
    $db = new db();
    $ws = new wsUtils();
    
    $data = array(
        "player" => filter_input(INPUT_POST, "player"),
        "acertos" => filter_input(INPUT_POST, "acertos"),
        "erros" => filter_input(INPUT_POST, "erros"),
        "passadas" => filter_input(INPUT_POST, "passadas")
    );
    
    $result = $db->insert("placar", $data);
    
    if($result != 0){
        $ws->response(1, "Placar inserido com sucesso", null);
    }
