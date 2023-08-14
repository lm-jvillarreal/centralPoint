<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIGrupoCali;
use CodeIgniter\HTTP\Response;

class mCDIGrupoCalis extends BaseController{

    public function index(){

    }
    public function listar(){
        $grupos = new mCDIGrupoCali();
        $grupos=$grupos->listarGrupos();
        $array=[];
        foreach($grupos as $resultado){
            array_push($array,[
                "id"=>$resultado["id"],
                
                "nivel"=>$resultado["nivel"],
                
            ]);
        }
        echo json_encode($array);
    }

    

}
?>