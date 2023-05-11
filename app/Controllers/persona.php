<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\UsuariosPerfiles;
use App\Models\Personas;
use App\Models\Usuarios;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Session\Session;

class persona extends BaseController{
    public function index(){

    }
    public function listar(){
        $personas = new Personas();
        $personas = $personas->listarPersonas();
        $array=[];
        foreach($personas as $resultado){
            array_push($array,[
                "id"=>$resultado['ID'],
                "nombre"=>$resultado['NOMBRE'],
                "sede"=>$resultado['SEDE'],
                "tipo_persona"=>$resultado['TIPO_PERSONA']
			]);
        }
        echo json_encode($array);
    }
	public function select(){
		$personas=new Personas();
		$searchTerm=$this->request->getPost('searchTerm');
		$personas = $personas->listarSelect($searchTerm);
		$data=[];
		foreach ($personas as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
		}
		echo json_encode($data);
	}
	public function campos(){
		$personas=new Personas();
		$id_persona=$this->request->getPost("id");
		$id_persona=(!empty($id_persona)) ? $id_persona : session("id_persona");
        $personas=$personas->camposPersona($id_persona);
        echo json_encode(
            	[
					"id" => $personas[0]['ID'],
					"nombre" => $personas[0]['NOMBRE'],
					"ap_paterno" => $personas[0]['AP_PATERNO'],
					"ap_materno" => $personas[0]['AP_MATERNO'],
					"id_sede" => $personas[0]['ID_SEDE'],
					"nombre_sede"=>$personas[0]['NOMBRE_SEDE'],
					"titulo"=>$personas[0]['TITULO'],
					"sexo"=>$personas[0]['SEXO'],
					"curp"=>$personas[0]['CURP'],
					"eCivil"=>$personas[0]["ECIVIL"],
					"rfc"=>$personas[0]["RFC"],
					"celular"=>$personas[0]["TELEFONO"],
					"email"=>$personas[0]["EMAIL"],
					"id_tipoPersona"=>$personas[0]['ID_TIPO'],
					"tipo_tipoPersona"=>$personas[0]['TIPO']
				]
            );
	}
    public function insertar(){
        if (!$this->validate([
			'txt_nombre' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
            'txt_apPaterno' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar el apellido paterno"
				]
            ],
			'txt_apMaterno' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar el apellido materno"
				]
            ],
            'txt_sede' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar una sede"
				]
			],
			'txt_tipoPersona' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un tipo de persona"
				]
            ]
		])) {
			$nombre = $this->validator->getError('txt_nombre');
            $ap_paterno = $this->validator->getError('txt_apPaterno');
			$ap_materno = $this->validator->getError('txt_apMaterno');
            $sede = $this->validator->getError('txt_sede');
			$tipo_persona = $this->validator->getError('txt_tipoPersona');
			$errores = [
				'nombre' => $nombre,
                'ap_paterno'=>$ap_paterno,
				'ap_materno' => $ap_materno,
                'sede'=>$sede,
				'tipo_persona'=>$tipo_persona
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_persona=$this->request->getPost('id');
			$nombre = $this->request->getPost('txt_nombre');
            $ap_paterno = $this->request->getPost('txt_apPaterno');
			$ap_materno = $this->request->getPost('txt_apMaterno');
            $sede = $this->request->getPost('txt_sede');
			$tipo_persona = $this->request->getPost('txt_tipoPersona');
			$personas = new Personas();
			if($id_persona==""){
				$personas = $personas->insertarPersona($nombre, $ap_paterno, $ap_materno, $sede, $tipo_persona);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_persona!=""){
				$personas = $personas->editarPersona($id_persona, $nombre, $ap_paterno, $ap_materno, $sede, $tipo_persona);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
	public function eliminar(){
		$personas = new Personas();
        $id_persona=$this->request->getPost('id');
        $personas=$personas->eliminarPersona($id_persona);
        echo json_encode(["msg"=>"eliminado"]);
    }
	public function passReset(){
		if (!$this->validate([
			'txt_pass' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Este campo es requerido"
				]
			],
            'txt_pass_verificar' => [
				'rules' => 'required|matches[txt_pass]',
				'errors' => [
					'required' => "Este campo es requerido",
					'matches'=>"Las contraseñas no coinciden"
				]
            ]
		])) {
			$pass = $this->validator->getError('txt_pass');
            $pass_verificar = $this->validator->getError('txt_pass_verificar');
			$errores = [
				'pass' => $pass,
                'pass_verificar'=>$pass_verificar
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_usuario=session("id_usuario");
			$pass=$this->request->getPost('txt_pass');
			$pass_verificar = $this->request->getPost('txt_pass_verificar');
			$personas = new Personas();
			if($pass==$pass_verificar){
				$personas = $personas->passReseter($id_usuario,$pass);
				echo json_encode(['msg' => 'actualizado']);
			}else if($pass!=$pass_verificar){
				echo json_encode(['msg' => 'no_coincide']);
			}
		}
	}
	public function passRes(){
		$usuarios = new Personas();
		$id_usuario=$this->request->getPost("id");
		$pass="123456789";
		$usuarios=$usuarios->passReseter($id_usuario,$pass);
		echo json_encode(["msg"=>"restaurado"]);

	}
	public function misDatos(){
		$personas=new Personas();
		$id_usuario=Session("id_persona");
		$titulo=$this->request->getPost('txt_titulo');
		$nombre=$this->request->getPost('txt_nombre');
		$ap_paterno=$this->request->getPost('txt_apPaterno');
		$ap_materno=$this->request->getPost('txt_apMaterno');
		$sexo=$this->request->getPost('txt_sexo');
		$curp=$this->request->getPost('txt_curp');
		$ecivil=$this->request->getPost('txt_eCivil');
		$departamento=$this->request->getPost('txt_departamento');
		$num_empleado=$this->request->getPost('txt_numEmp');
		$rfc=$this->request->getPost('txt_rfc');
		$celular=$this->request->getPost('txt_celular');
		$email=$this->request->getPost('txt_email');
		$personas=$personas->misDatos($id_usuario,$titulo,$nombre,$ap_paterno,$ap_materno,$sexo,$curp,$ecivil,$departamento,$num_empleado,$rfc,$celular,$email);
		echo json_encode(array("msg"=>"actualizado"));
	}
}
?>