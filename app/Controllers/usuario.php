<?php
namespace App\Controllers;

use App\Libraries\Functions;
use App\Models\Personas;
use CodeIgniter\HTTP\Response;
use App\Models\Usuarios;

class usuario extends BaseController{
    public function index(){

    }
    public function listar(){
        $usuarios=new Usuarios();
        $usuarios=$usuarios->listar();
        $data=array();
        foreach($usuarios as $resultado){
            array_push($data,array(
                'id'=>$resultado["ID"],
                'colaborador'=>$resultado['COLABORADOR'],
                'usuario'=>$resultado['NOMBRE_USUARIO'],
                'perfil'=>$resultado['PERFIL']
            ));
        }
        echo json_encode($data);
        
    }
    public function select(){
		$usuarios=new Usuarios();
		$searchTerm=$this->request->getPost('searchTerm');
		$usuarios = $usuarios->listarSelect($searchTerm);
		$data=array();
		foreach ($usuarios as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['PUESTO']);
		}
		echo json_encode($data);
	}
    public function campos(){
        $id_usuario=$this->request->getPost("id");
		$usuarios=new Usuarios();
		$usuarios=$usuarios->camposUsuario($id_usuario);
		echo json_encode(
			array(
				"id_colaborador"=>$usuarios[0]['ID_COLABORADOR'],
				"id_perfil"=>$usuarios[0]["ID_PERFIL"],
				"nombre_colaborador"=>$usuarios[0]["COLABORADOR"],
				"nombre_perfil"=>$usuarios[0]["PERFIL"]
			)
			);

    }
    public function insertar()
	{
		if (!$this->validate([
			'txt_colaborador' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes seleccionar un colaborador"
				]
			],
			'txt_perfil' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes seleccionar un perfil"
				]
			]
		])) {
			$colaborador = $this->validator->getError('txt_colaborador');
			$perfil = $this->validator->getError('txt_perfil');
			$errores = [
				'colaborador' => $colaborador,
				'perfil' => $perfil
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_usuario=$this->request->getPost('id');
			$colaborador = $this->request->getPost('txt_colaborador');
			$perfil = $this->request->getPost('txt_perfil');
            $persona=new Personas();
            $persona=$persona->camposPersona($colaborador);
            $nombre=$persona[0]['NOMBRE'];
            $ap_paterno=$persona[0]['AP_PATERNO'];
            $usr=strtolower($nombre[0].$ap_paterno);
			$usuarios = new Usuarios();
			if($id_usuario==""){
				$usuarios = $usuarios->insertarUsuario($colaborador, $perfil ,$usr);
				echo json_encode(array('msg' => 'insertado'));
			}else if($id_usuario!=""){
				$usuarios = $usuarios->editarUsuario($id_usuario, $colaborador, $perfil);
				echo json_encode(array('msg' => 'editado'));
			}
		}
	}
}

?>