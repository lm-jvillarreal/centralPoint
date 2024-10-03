<?php
namespace App\Controllers;
use App\Models\ComDeptos;

 class comDepto extends BaseController{
    public function index(){

    }
    public function listar(){
    $departamentos = new ComDeptos();
    $departamentos=$departamentos->listarDepartamentos();
    $array=[];
    foreach($departamentos as $resultado){
        array_push($array,[
        "id"=>$resultado["ID"],
        "cve_depto"=>$resultado["CVE_DEPTO"],
				"descripcion_depto"=>$resultado["DESCRIPCION_DEPTO"]
        ]);
    }
    echo json_encode($array);
    //print_r($asignaciones);
    }
    public function insertar(){
      if (!$this->validate([
				'txt_cveDepto' => [
					'rules' => 'required',
					'errors' => [
						"required" => "Debes ingresar una clave"
					]
				],
					'txt_descripcionDepto' => [
					'rules' => 'required',
					'errors' => [
						'required' => "Debes ingresar una descripción"
					]
				]
			])) {
				$clave = $this->validator->getError('txt_cveDepto');
				$descripcion = $this->validator->getError('txt_descripcionDepto');
				$errores = [
					'departamento' => $clave,
					'descripcionDepto'=>$descripcion,
				];
				echo json_encode($errores);
				$response = service('response');

				$response->setStatusCode(400);
				$response->setHeader('Content-type', 'text/html');
				$response->noCache();
				$response->send();
			} else {
				$id_departamento=$this->request->getPost('id');
				$departamento = $this->request->getPost('txt_cveDepto');
				$descripcion = $this->request->getPost('txt_descripcionDepto');
				$departamentos = new ComDeptos();
				if($id_departamento==""){
					$departamentos = $departamentos->insertarDepartamento($departamento,$descripcion);
					echo json_encode(['msg' => 'insertado']);
				}else if($id_departamento!=""){
					$departamentos = $departamentos->editarDepartamento($id_departamento,$departamento,$descripcion);
					echo json_encode(['msg' => 'editado']);
				}
			}
    }
		public function eliminar(){
			$departamento=new ComDeptos();
			$id_departamento=$this->request->getPost('id');
			$departamento=$departamento->eliminarDepartamento($id_departamento);
			echo json_encode(['msg'=>'eliminado']);
	}
 }
?>