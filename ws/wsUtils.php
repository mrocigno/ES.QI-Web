<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teste
 *
 * @author Matheus
 */
class wsUtils {
    //put your code here
    public function response($status, $result, $data){
        echo json_encode(array(
            "status" => $status,
            "result" => $result,
            "data" => ($data == null? (object) $data: $data)
        ));
    }
}
