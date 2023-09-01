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
                "id_evaluacion" => $resultado["id_evaluacion"],
                "id_alumno" => $resultado["id_alumno"],
                "calificacion" => $resultado["calificacion"]
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($array);
    }
    
    public function select1(){
        $grupos= new mCDICalificar();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelect1($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nombre']];
        }
        echo json_encode($data);
    }
    


}
?>