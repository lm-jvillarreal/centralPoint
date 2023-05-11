<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Edificios;
use CodeIgniter\HTTP\Response;

class edificio extends BaseController{
    public function index(){

    }
    public function listar(){
        $edificios=new Edificios();
        $edificios=$edificios->listarEdificios();
        $data=[];
        foreach($edificios as $resultado){
            array_push($data,[
                "id"=>$resultado['ID'],
                "edificio"=>$resultado['NOMBRE'],
                "abreviatura"=>$resultado['ABREVIATURA']
			]);
        }
        echo json_encode($data);
    }
    public function select()
	{
		$edificios=new Edificios();
		$searchTerm=$this->request->getPost('searchTerm');
		$edificios = $edificios->listarSelect($searchTerm);
		$data=[];
		foreach ($edificios as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
		}
		echo json_encode($data);
	}
    public function insertar(){
        if (!$this->validate([
			'txt_edificio' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
            'txt_abreviatura' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una abreviatura"
				]
            ]
		])) {
			$edificio = $this->validator->getError('txt_edificio');
			$abreviatura = $this->validator->getError('txt_abreviatura');
			$errores = [
				'edificio' => $edificio,
				'abreviatura' => $abreviatura,
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_edificio=$this->request->getPost('id');
			$edificio = $this->request->getPost('txt_edificio');
			$abreviatura = $this->request->getPost('txt_abreviatura');
			$edificios = new Edificios();
			if($id_edificio==""){
				$edificios = $edificios->insertarEdificios($edificio,$abreviatura);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_edificio!=""){
				$edificios = $edificios->editarEdificios($id_edificio,$edificio,$abreviatura);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
    public function eliminar(){
        $id_edificio=$this->request->getPost('id');
        $edificios=new Edificios();
        $edificios=$edificios->eliminarEdificios($id_edificio);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>