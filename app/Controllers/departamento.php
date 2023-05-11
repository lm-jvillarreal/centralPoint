<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Departamentos;
use CodeIgniter\HTTP\Response;

class departamento extends BaseController{
    public function index(){
    }
    public function listar(){
        $departamentos=new Departamentos();
        $departamentos=$departamentos->listarDepartamentos();
        $data=[];
        foreach($departamentos as $resultado){
            array_push($data,[
                "id"=>$resultado["ID"],
                "departamento"=>$resultado["NOMBRE"],
                "abreviatura"=>$resultado["ABREVIATURA"],
                "extension"=>$resultado["EXTENSION"],
                "responsable"=>$resultado["RESPONSABLE"]
			]);
        }
        echo json_encode($data);
    }
    public function select()
	{
		$departamentos=new Departamentos();
		$searchTerm=$this->request->getPost('searchTerm');
		$departamentos = $departamentos->listarSelect($searchTerm);
		$data=[];
		foreach ($departamentos as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
		}
		echo json_encode($data);
	}
    public function campos(){
        $departamentos=new Departamentos();
        $id_departamento=$this->request->getPost('id');
        $departamentos=$departamentos->camposDepartamento($id_departamento);
        echo json_encode(
				[
					"id" => $departamentos[0]['ID'],
					"departamento" => $departamentos[0]['NOMBRE'],
					"extension" => $departamentos[0]['EXTENSION'],
					"abreviatura" => $departamentos[0]['ABREVIATURA'],
					"id_responsable" => $departamentos[0]['ID_PERSONA'],
					"nombre_responsable"=>$departamentos[0]['RESPONSABLE']
				]
			);
    }
    public function insertar(){
        if (!$this->validate([
			'txt_departamento' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
            'txt_extension' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una extensión"
				]
            ],
			'txt_abreviatura' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una abreviatura"
				]
            ],
            'txt_responsable' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un responsable"
				]
            ]
		])) {
			$departamento = $this->validator->getError('txt_departamento');
            $extension = $this->validator->getError('txt_extension');
			$abreviatura = $this->validator->getError('txt_abreviatura');
            $responsable = $this->validator->getError('txt_responsable');
			$errores = [
				'departamento' => $departamento,
                'extension'=>$extension,
				'abreviatura' => $abreviatura,
                'responsable'=>$responsable
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_departamento=$this->request->getPost('id');
			$departamento = $this->request->getPost('txt_departamento');
            $extension = $this->request->getPost('txt_extension');
			$abreviatura = $this->request->getPost('txt_abreviatura');
            $responsable = $this->request->getPost('txt_responsable');
			$departamentos = new Departamentos();
			if($id_departamento==""){
				$departamentos = $departamentos->insertarDepartamento($departamento,$extension,$abreviatura,$responsable);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_departamento!=""){
				$departamentos = $departamentos->editarDepartamento($id_departamento,$departamento,$extension,$abreviatura,$responsable);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
    public function eliminar()
    {
        $departamentos = new Departamentos();
        $id_departamento=$this->request->getPost('id');
        $departamentos=$departamentos->eliminarDepartamento($id_departamento);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>