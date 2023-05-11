<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Colaboradores;
use App\Models\Edificios;
use App\Models\Personas;
use CodeIgniter\HTTP\Response;

class colaborador extends BaseController{
    public function index(){
    }
    public function listar(){
        $colaboradores=new Colaboradores();
        $colaboradores=$colaboradores->listarColaboradores();
        $array=[];
        foreach($colaboradores as $resultado){
            array_push($array,[
                "id"=>$resultado['ID'],
                "num_emp"=>$resultado['NUM_EMPLEADO'],
                "persona"=>$resultado['Persona'],
                "sede"=>$resultado['Sede'],
                "depto"=>$resultado['Depto'],
                "puesto"=>$resultado['Puesto'],
                "tipo_persona"=>$resultado['Tipo_persona']
			]);
        }
        echo json_encode($array);
    }
    public function select(){
		$colaboradores=new Colaboradores();
		$searchTerm=$this->request->getPost('searchTerm');
		$colaboradores = $colaboradores->listarSelect($searchTerm);
		$data=[];
		foreach ($colaboradores as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['COLABORADOR']];
		}
		echo json_encode($data);
	}
    public function campos(){
		$colaboradores=new Colaboradores();
		$id_colaborador=$this->request->getPost("id");
        $colaboradores=$colaboradores->camposColaborador($id_colaborador);
        echo json_encode(
            [
				"id"=>$colaboradores[0]['ID'],
				"no_empleado"=>$colaboradores[0]['NUM_EMPLEADO'],
				"id_persona"=>$colaboradores[0]['ID_PERSONA'],
				"id_sede"=>$colaboradores[0]['ID_SEDE'],
				"id_departamento"=>$colaboradores[0]['ID_DEPARTAMENTO'],
				"id_puesto"=>$colaboradores[0]['ID_PUESTO'],
				"persona"=>$colaboradores[0]['PERSONA'],
				"sede"=>$colaboradores[0]['SEDE'],
				"departamento"=>$colaboradores[0]['DEPARTAMENTO'],
				"puesto"=>$colaboradores[0]['PUESTO']
			]
        );
	}
    public function insertar(){
        if (!$this->validate([
			'txt_persona' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes seleccionar una persona"
				]
			],
            'txt_numEmp' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar un número de empleado"
				]
            ],
			'txt_departamento' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un departamento"
				]
            ],
            'txt_puesto' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un puesto"
				]
			]
		])) {
			$persona = $this->validator->getError('txt_persona');
            $no_empleado = $this->validator->getError('txt_numEmp');
			$departamento = $this->validator->getError('txt_departamento');
            $puesto = $this->validator->getError('txt_puesto');
			$errores = [
				'persona' => $persona,
                'no_empleado'=>$no_empleado,
				'departamento' => $departamento,
                'puesto'=>$puesto
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_colaborador=$this->request->getPost('id');
			$persona = $this->request->getPost('txt_persona');
            $no_empleado = $this->request->getPost('txt_numEmp');
			$departamento = $this->request->getPost('txt_departamento');
            $puesto = $this->request->getPost('txt_puesto');
            $personas=new Personas();
            $personas=$personas->camposPersona($persona);
            $id_sede=$personas[0]["ID_SEDE"];
            $tipo_persona=$personas[0]["ID_TIPO"];
			$colaboradores = new colaboradores();
			if($id_colaborador==""){
				$colaboradores = $colaboradores->insertarColaborador($persona, $no_empleado, $departamento, $puesto, $id_sede, $tipo_persona);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_colaborador!=""){
				$colaboradores = $colaboradores->editarColaborador($id_colaborador, $persona, $no_empleado, $departamento, $puesto, $id_sede, $tipo_persona);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
    public function eliminar(){
		$colaborador = new Colaboradores();
        $id_colaborador=$this->request->getPost('id');
        $colaborador=$colaborador->eliminarColaborador($id_colaborador);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>