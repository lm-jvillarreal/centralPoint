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
        $detalle = new mCDICalificar();
        $detalle=$detalle->listarEvaluacion();
        $array=[];
        foreach($detalle as $resultado){
            array_push($array,[
                "id"=>$resultado["id"],
                "Nombre"=>$resultado["Nombre"]
            ]);
        }
        echo json_encode($array);
    }


}
?>