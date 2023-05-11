<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\ModulosCategorias;
use App\Models\UsuariosPerfiles;
use CodeIgniter\HTTP\Response;

class usuariosPerfil extends BaseController{
    public function index()
    {
    }
    public function listar(){
        $perfiles = new UsuariosPerfiles();
        $perfiles = $perfiles->listarPerfiles();
        $array=array();
        foreach($perfiles as $resultado){
            array_push($array,array(
                "id"=>$resultado["ID"],
                "nombre"=>$resultado["NOMBRE"],
                "descripcion"=>$resultado["DESCRIPCION"]
            ));
        }
        echo json_encode($array);
    }
	public function select(){
		$perfiles=new UsuariosPerfiles();
		$searchTerm=$this->request->getPost('searchTerm');
		$perfiles = $perfiles->listarSelect($searchTerm);
		$data=array();
		foreach ($perfiles as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']);
		}
		echo json_encode($data);
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
			'txt_descripcion' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
			]
		])) {
			$perfil = $this->validator->getError('txt_perfil');
			$descripcion = $this->validator->getError('txt_descripcion');
			$errores = [
				'perfil' => $perfil,
				'descripcion' => $descripcion
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_perfil=$this->request->getPost('id');
			$perfil = $this->request->getPost('txt_perfil');
			$descripcion = $this->request->getPost('txt_descripcion');
			$perfiles = new UsuariosPerfiles();
			if($id_perfil==""){
				$perfiles = $perfiles->insertarPerfil($perfil, $descripcion);
				echo json_encode(array('msg' => 'insertado'));
			}else if($id_perfil!=""){
				$perfiles = $perfiles->editarPerfil($id_perfil, $perfil, $descripcion);
				echo json_encode(array('msg' => 'editado'));
			}
		}
	}
    public function eliminar()
    {
        $perfiles=new UsuariosPerfiles();
        $id_perfil=$this->request->getPost("id");
        $perfiles=$perfiles->eliminarPerfil($id_perfil);
        echo json_encode(array("msg" => "eliminado"));
    }
}
?>