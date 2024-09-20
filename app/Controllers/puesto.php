<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use App\Models\Puestos;

class puesto extends BaseController{
	public function index(){

	}
	public function listar(){
		$puestos = new Puestos();
		$puestos=$puestos->listarPuestos();
		$array=[];
		foreach($puestos as $resultado){
				array_push($array,[
						"id"=>$resultado["ID"],
						"nombre"=>$resultado["PUESTO"],
						"descripcion"=>$resultado["DESCRIPCION"]
				]);
		}
		echo json_encode($array);
		//print_r($puestos);
		//Imprime la consulta que vinene del model
	}
	public function select(){
		$puestos=new Puestos();
		$searchTerm=$this->request->getPost('searchTerm');
		$puestos = $puestos->listarSelect($searchTerm);
		$data=array();
		foreach ($puestos as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['PUESTO']);
		}
		echo json_encode($data);
	}
	public function insertar(){
		if (!$this->validate([
			'txt_puesto' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_descripcion' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$puesto = $this->validator->getError('txt_puesto');
			$descripcion = $this->validator->getError('txt_descripcion');
			$errores = [
				'puesto' => $puesto,
				'descripcion' => $descripcion
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_puesto=$this->request->getPost('id');
			$puesto = $this->request->getPost('txt_puesto');
			$descripcion = $this->request->getPost('txt_descripcion');
			$puestos = new Puestos();
			if($id_puesto==""){
				$puestos = $puestos->insertarPuesto($puesto, $descripcion);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_puesto!=""){
				$puestos = $puestos->editarPuesto($id_puesto, $puesto, $descripcion);
				echo json_encode(['msg' => 'editado']);
			}
		}
	}
	public function eliminar(){
		$puestos = new Puestos();
		$id_puesto=$this->request->getPost('id');
		$puestos = $puestos->eliminarPuesto($id_puesto);
		echo json_encode(['msg' => 'eliminado']);
	}
}

?>