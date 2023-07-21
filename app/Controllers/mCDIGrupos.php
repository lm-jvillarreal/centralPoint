<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIGrupo;
use CodeIgniter\HTTP\Response;

class mCDIGrupos extends BaseController{

    public function index(){

    }
    public function listar(){
        $grupos = new mCDIGrupo();
        $grupos=$grupos->listarGrupos();
        $array=[];
        foreach($grupos as $resultado){
            array_push($array,[
                "id"=>$resultado["id"],
                "id_Plan"=>$resultado["id_Plan"],
                "id_periodo"=>$resultado["id_periodo"],
                "nivel"=>$resultado["nivel"],
                "id_docente"=>$resultado["id_docente"]
            ]);
        }
        echo json_encode($array);
    }

    public function select1(){
        $grupos= new mCDIGrupo();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelect1($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nombre']];
        }
        echo json_encode($data);
    }
	public function select2(){
        $grupos= new mCDIGrupo();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelect2($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['periodo']];
        }
        echo json_encode($data);
    }
	public function campos(){
		$grupos= new mCDIGrupo();
		$id=$this->request->getPost('id');
		$grupos=$grupos->camposGrupos($id);
		echo json_encode(
			[
				"id" => $grupos[0]['id'],
				"id_Plan" => $grupos[0]['id_Plan'],
				"id_periodo" => $grupos[0]['id_periodo'],
				"nivel" => $grupos[0]['nivel'],
				"id_docente" => $grupos[0]['id_docente']
			]
			);
	}

    public function insertar(){
		if (!$this->validate([
			'txt_id_Plan' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_id_periodo' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			],
			'txt_nivel' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_id_docente' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$plan = $this->validator->getError('txt_id_Plan');
			$periodo = $this->validator->getError('txt_id_periodo');
			$nivel = $this->validator->getError('txt_nivel');
			$docente = $this->validator->getError('txt_id_docente');
			$errores = [
				'id_Plan' => $plan,
				'id_periodo' => $periodo,
				'nivel' => $nivel,
				'id_docente' => $docente
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id=$this->request->getPost('id');
			$plan = $this->request->getPost('txt_id_Plan');
			$periodo = $this->request->getPost('txt_id_periodo');
			$nivel = $this->request->getPost('txt_nivel');
			$docente = $this->request->getPost('txt_id_docente');
			$grupos = new mCDIGrupo();
			if($id==""){
				$grupos = $grupos->insertarGrupo($plan, $periodo, $nivel, $docente);
				echo json_encode(['msg' => 'insertado']);
			}else if($id!=""){
				$grupos = $grupos->editarGrupo($id, $plan, $periodo, $nivel, $docente);
				echo json_encode(['msg' => 'editado']);
			}
		}
	}
    public function eliminar(){
		$categorias = new mCDIGrupo();
		$id=$this->request->getPost('id');
		$categorias = $categorias->eliminarGrupo($id);
		echo json_encode(['msg' => 'eliminado']);
	}

}
?>