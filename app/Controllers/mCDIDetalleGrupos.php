<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIDetalleGrupo;
use App\Models\mCDIDetalleG;
use CodeIgniter\HTTP\Response;

class mCDIDetalleGrupos extends BaseController{

    public function index(){

    }
    public function listar(){
        $detalle = new mCDIDetalleG();
        $detalle=$detalle->listarGrupo();
        $array=[];
        foreach($detalle as $resultado){
            array_push($array,[
                "id"=>$resultado["id"],
                "id_grupo"=>$resultado["id_grupo"],
                "id_alumno"=>$resultado["id_alumno"]
            ]);
        }
        echo json_encode($array);
    }

    public function select(){
        $grupos= new mCDIDetalleG();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelects($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nivel']];
        }
        echo json_encode($data);
    }
	public function campos(){
		$grupos= new mCDIDetalleG();
		$id=$this->request->getPost('id');
		$grupos=$grupos->camposGrupos($id);
		echo json_encode(
			[
				"id" => $grupos[0]['id'],
				"id_grupo" => $grupos[0]['id_Plan'],
				"id_alumno" => $grupos[0]['id_periodo']
			]
			);
	}

    public function insertar(){
		if (!$this->validate([
			'txt_grupo' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_alumno' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$grupo = $this->validator->getError('txt_grupo');
			$alumno = $this->validator->getError('txt_alumno');
			
			$errores = [
				'id_grupo' => $grupo,
				'id_alumno' => $alumno
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id=$this->request->getPost('id');
			$grupo = $this->request->getPost('txt_grupo');
			$alumno = $this->request->getPost('txt_alumno');
			$grupos = new mCDIDetalleG();
			if($id==""){
				$grupos = $grupos->insertarGrupos($grupo, $alumno);
				echo json_encode(['msg' => 'insertado']);
			}else if($id!=""){
				$grupos = $grupos->editarGrup($id, $grupo, $alumno);
				echo json_encode(['msg' => 'editado']);
			}
		}
	}
    public function eliminar(){
		$categorias = new mCDIDetalleG();
		$id=$this->request->getPost('id');
		$categorias = $categorias->eliminarGrupos($id);
		echo json_encode(['msg' => 'eliminado']);
	}

}
?>