<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIDetalleGrupo;
use App\Models\mCDICalificar;
use CodeIgniter\HTTP\Response;

class mCDICalificars extends BaseController{

    public function index(){

    }
    public function listar(){
        $gruposModel = new mCDICalificar();
        $grupos = $gruposModel->listardetalle();
    
        $array = [];
        foreach ($grupos as $resultado) {
            $array[] = [
                "id" => $resultado["id"],
                "nombre" => $resultado["nombre"],
                "id_alumno" => $resultado["id_alumno"],
                "calificacion" => $resultado["calificacion"]
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($array);
    }
    
    


}
?>