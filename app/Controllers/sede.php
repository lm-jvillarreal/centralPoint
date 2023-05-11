<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Sedes;
use CodeIgniter\HTTP\Response;

class sede extends BaseController{
    public function index(){

    }
    public function listar(){
		$sedes=new Sedes();
		$sedes=$sedes->listarSedes();
		$data=array();
		foreach($sedes as $resultado){
			array_push($data,array(
				"id"=>$resultado['ID'],
				"sede"=>$resultado['NOMBRE'],
				"abreviatura"=>$resultado['ABREVIATURA'],
				"direccion"=>$resultado['DIRECCION']
			));
		}
		echo json_encode($data);
    }
    public function select()
	{
		$sedes=new Sedes();
		$searchTerm=$this->request->getPost('searchTerm');
		$sedes = $sedes->listarSelect($searchTerm);
		$data=array();
		foreach ($sedes as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']);
		}
		echo json_encode($data);
	}
	public function insertar()
	{
		if (!$this->validate([
			'txt_sede' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_abreviatura' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar una abreviatura"
				]
			],
			'txt_direccion' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$sede = $this->validator->getError('txt_sede');
			$abreviatura = $this->validator->getError('txt_abreviatura');
			$direccion = $this->validator->getError('txt_direccion');
			$errores = [
				'sede' => $sede,
				'abreviatura' => $abreviatura,
				'direccion' => $direccion
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_sede=$this->request->getPost('id');
			$sede = $this->request->getPost('txt_sede');
			$abreviacion = $this->request->getPost('txt_abreviacion');
			$direccion = $this->request->getPost('txt_direccion');
			$sedes = new Sedes();
			if($id_sede==""){
				$sedes = $sedes->insertarSede($sede, $abreviacion, $direccion);
				echo json_encode(array('msg' => 'insertado'));
			}else if($id_sede!=""){
				$sedes = $sedes->editarSede($id_sede, $sede, $abreviacion, $direccion);
				echo json_encode(array('msg' => 'editado'));
			}
		}
	}
	public function eliminar(){
		$id_sede=$this->request->getPost('id');
		$sedes=new Sedes();
		$sedes=$sedes->eliminarSede($id_sede);
		echo json_encode(array("msg"=>"eliminado"));
	}
}
?>