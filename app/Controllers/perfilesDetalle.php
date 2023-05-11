<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\PerfilesDetalles;
use CodeIgniter\HTTP\Response;

class perfilesDetalle extends BaseController
{
    public function index()
    {
    }
    public function listar()
    {
        $detalle = new PerfilesDetalles();
        $detalle = $detalle->listarDetalles();
        $array=[];
        foreach($detalle as $resultado){
            array_push($array,[
                "id"=>$resultado["ID"],
                "perfil"=>$resultado["PERFIL"],
                "modulo"=>$resultado["MODULO"]
			]);
        }
        echo json_encode($array);
    }
    public function insertar()
    {
		if (!$this->validate([
			'txt_perfil' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_modulo' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$perfil = $this->validator->getError('txt_perfil');
			$modulo = $this->validator->getError('txt_modulo');
			$errores = [
				'perfil' => $perfil,
				'modulo' => $modulo
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$perfil = $this->request->getPost('txt_perfil');
			$modulo = $this->request->getPost('txt_modulo');
			$detalle = new PerfilesDetalles();
			$detalle = $detalle->insertarDetalle($perfil, $modulo);
			echo json_encode(["msg"=>"insertado"]);
		}
	}
	public function eliminar(){
		$detalle = new PerfilesDetalles();
		$id_detalle=$this->request->getPost('id');
		$detalle=$detalle->eliminarDetalle($id_detalle);
		echo json_encode(['msg' => 'eliminado']);
	}
}
?>