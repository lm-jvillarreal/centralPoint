<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIEvaluacion;
use CodeIgniter\HTTP\Response;

class mCDIEvaluaciones extends BaseController{

    public function index(){

    }
    public function listar(){
        $grupos = new mCDIEvaluacion();
        $grupos=$grupos->listarGrupos();
        $array=[];
        foreach($grupos as $resultado){
            array_push($array,[
                "id"=>$resultado["id"],
                "nombre"=>$resultado["nombre"],
                "tipo_evaluacion"=>$resultado["tipo_evaluacion"]
                
                
            ]);
        }
        echo json_encode($array);
    }

    public function select1(){
        $grupos= new mCDIEvaluacion();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelect1($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nivel']];
        }
        echo json_encode($data);
    }
	public function select2(){
        $grupos= new mCDIEvaluacion();
        $searchTerm=$this->request->getPost("searchTerm");
        $grupos=$grupos->listarSelect2($searchTerm);
        $data=[];
        foreach($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['tipo']];
        }
        echo json_encode($data);
    }
	
	
	public function campos(){
		$grupos= new mCDIEvaluacion();
		$id=$this->request->getPost('id');
		$grupos=$grupos->camposGrupos($id);
		echo json_encode(
			[
				"id" => $grupos[0]['id'],
				"nombre" => $grupos[0]['nombre'],
				"tipo_evaluacion" => $grupos[0]['TipoEvaluacion'],
				
			]
			);
	}

    public function insertar(){
		if (!$this->validate([
			'txt_Grupo' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un Grupo"
				]
			],
			'txt_Nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar un Nombre"
				]
			],
			'txt_tipo' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un Tipo"
				]
			]
		])) {
			$Grupo = $this->validator->getError('txt_Grupo');
			$Nombre = $this->validator->getError('txt_Nombre');
			$TipoEvaluacion = $this->validator->getError('txt_tipo');
			$errores = [
				'id_grupo' => $Grupo,
				'nombre' => $Nombre,
				'nivel' => $TipoEvaluacion
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id=$this->request->getPost('id');
			$Grupo = $this->request->getPost('txt_Grupo');
			$Nombre = $this->request->getPost('txt_Nombre');
			$TipoEvaluacion = $this->request->getPost('txt_tipo');
			$grupos = new mCDIEvaluacion();
			if($id==""){
				$grupos = $grupos->insertarGrupo($Grupo, $Nombre, $TipoEvaluacion);
				echo json_encode(['msg' => 'insertado']);
			}else if($id!=""){
				$grupos = $grupos->editarGrupo($id, $Grupo, $Nombre, $TipoEvaluacion);
				echo json_encode(['msg' => 'editado']);
			}
		}
	}
    public function eliminar(){
		$categorias = new mCDIEvaluacion();
		$id=$this->request->getPost('id');
		$categorias = $categorias->eliminarGrupo($id);
		echo json_encode(['msg' => 'eliminado']);
	}

}
?>