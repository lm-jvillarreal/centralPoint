<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIPlanEstudios;
use CodeIgniter\HTTP\Response;

class mCDIPlanEstudio extends BaseController{
    public function index(){
    }
    public function listar(){
        $planestudios=new mCDIPlanEstudios();
        $planestudios=$planestudios->listarPlanEstudios();
        $data=[];
        foreach($planestudios as $resultado){
            array_push($data,[
                "id"=>$resultado["id"],
                "clave"=>$resultado["clave"],
                "nombre"=>$resultado["nombre"],
			]);
        }
        echo json_encode($data);
    }
    public function select()
	{
		$planestudios=new mCDIPlanEstudios();
		$searchTerm=$this->request->getPost('searchTerm');
		$planestudios = $planestudios->listarSelect($searchTerm);
		$data=[];
		foreach ($planestudios as $resultado){
			$data[]=["id"=>$resultado['id'], "text"=>$resultado['nombre']];
		}
		echo json_encode($data);
	}
    public function campos(){
        $planestudios=new mCDIPlanEstudios();
        $id=$this->request->getPost('id');
        $planestudios=$planestudios->camposPlanEstudio($id);
        echo json_encode(
				[
					"id" => $planestudios[0]['id'],
					"clave" => $planestudios[0]['clave'],
					"nombre" => $planestudios[0]['nombre'],
				]
			);
    }
    public function insertar(){
        if (!$this->validate([
			'txt_clave' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar una clave"
				]
			],
            'txt_nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una nombre"
				]
            ],
		])) {
			$clave = $this->validator->getError('txt_clave');
            $nombre = $this->validator->getError('txt_nombre');
			$errores = [
				'clave' => $clave,
                'nombre'=>$nombre,
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id=$this->request->getPost('id');
			$clave = $this->request->getPost('txt_clave');
            $nombre = $this->request->getPost('txt_nombre');
			$planestudios = new mCDIPlanEstudios();
			if($id==""){
				$planestudios = $planestudios->insertarPlanEstudio($clave, $nombre);
				echo json_encode(['msg' => 'insertado']);
			}else if($id!=""){
				$planestudios = $planestudios->editarPlanEstudio($id, $clave, $nombre);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
    public function eliminar()
    {
        $planestudios = new mCDIPlanEstudios();
        $id=$this->request->getPost('id');
        $planestudios=$planestudios->eliminarPlanEstudio($id);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>