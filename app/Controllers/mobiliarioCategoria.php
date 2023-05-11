<?php
namespace App\Controllers;
use App\Models\MobiliarioCategorias;

class mobiliarioCategoria extends BaseController{
    public function index(){

    }
    public function listar(){
        $categorias = new MobiliarioCategorias();
        $categorias=$categorias->listarCategorias();
        $array=[];
        foreach($categorias as $resultado){
            array_push($array,[
                "id"=>$resultado["ID"],
                "nombre"=>$resultado["NOMBRE"],
                "descripcion"=>$resultado["DESCRIPCION"]
            ]);
        }
        echo json_encode($array);
    }

    public function select(){
        $categorias= new MobiliarioCategorias();
        $searchTerm=$this->request->getPost("searchTerm");
        $categorias=$categorias->listarSelect($searchTerm);
        $data=[];
        foreach($categorias as $resultado){
            $data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
        }
        echo json_encode($data);
    }

    public function insertar(){
		if (!$this->validate([
			'txt_categoria' => [
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
			$categoria = $this->validator->getError('txt_categoria');
			$descripcion = $this->validator->getError('txt_descripcion');
			$errores = [
				'categoria' => $categoria,
				'descripcion' => $descripcion
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_categoria=$this->request->getPost('id');
			$categoria = $this->request->getPost('txt_categoria');
			$descripcion = $this->request->getPost('txt_descripcion');
			$categorias = new MobiliarioCategorias();
			if($id_categoria==""){
				$categorias = $categorias->insertarCategoria($categoria, $descripcion);
				echo json_encode(['msg' => 'insertado']);
			}else if($id_categoria!=""){
				$categorias = $categorias->editarCategoria($id_categoria, $categoria, $descripcion);
				echo json_encode(['msg' => 'editado']);
			}
		}
	}
    public function eliminar(){
		$categorias = new MobiliarioCategorias();
		$id_categoria=$this->request->getPost('id');
		$categorias = $categorias->eliminarCategoria($id_categoria);
		echo json_encode(['msg' => 'eliminado']);
	}
}
?>