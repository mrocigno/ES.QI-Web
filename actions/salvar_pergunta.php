<?php
    require '../db/db.php';
    
    $db = new db();

    if($_FILES['sltImg']['name'] != ""){
        $filename = sha1($_FILES['sltImg']['name'] . round(microtime(true) * 1000)) .".jpg";
        $target_file = $_SERVER['DOCUMENT_ROOT'] . "/uploads/". $filename;
        move_uploaded_file($_FILES['sltImg']['tmp_name'], $target_file);
    }else{
        $filename = "default.jpg";
    }
    
    $campos = array(
        "pergunta" => filter_input(INPUT_POST, "iptPergunta"),
        "reposta_certa" => filter_input(INPUT_POST, "iptCerta"),
        "reposta_errada1" => filter_input(INPUT_POST, "iptErrada1"),
        "reposta_errada2" => filter_input(INPUT_POST, "iptErrada2"),
        "reposta_errada3" => filter_input(INPUT_POST, "iptErrada3"),
        "foto" => $filename,
        "titulo" => filter_input(INPUT_POST, "iptTitulo")
    );
    
    $id = $db->insert("perguntas", $campos);
    
    header("Location: ../paginas/adicionar-perguntas.php?id=$id");