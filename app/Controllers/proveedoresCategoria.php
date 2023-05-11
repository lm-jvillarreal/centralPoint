<?php
namespace App\Controllers;
use App\Models\ProveedoresCategorias;

class proveedoresCategoria extends BaseController{
    public function index(){

    }
    public function listar(){
        $categorias=new ProveedoresCategorias();
        $categorias=$categorias->listar();
        $array=array();
        foreach($categorias as $resultado){
            array_push($array,array(
                "id"=>$resultado['ID'],
                "nombre"=>$resultado['NOMBRE'],
                "abreviatura"=>$resultado['ABREVIATURA'],
                "categoria"=>$resultado['CATEGORIA']
            ));
        }
        echo json_encode($array);
    }
	public function select(){
        $categoriaProveedor=new ProveedoresCategorias();
		$searchTerm=$this->request->getPost('searchTerm');
		$categoriaProveedor = $categoriaProveedor->listarSelect($searchTerm);
		$data=array();
		foreach ($categoriaProveedor as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']);
		}
		echo json_encode($data);
    }
    public function insertar()
	{
		if (!$this->validate([
			'txt_nombre' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
			'txt_abreviatura' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar una abreviatura"
				]
			],
			'txt_categoria' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una categoria"
				]
			]
		])) {
			$nombre = $this->validator->getError('txt_nombre');
			$abreviatura = $this->validator->getError('txt_abreviatura');
			$categoria = $this->validator->getError('txt_categoria');
			$errores = [
				'nombre' => $nombre,
				'abreviatura' => $abreviatura,
				'categoria' => $categoria
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_categ = $this->request->getPost('id');
			$nombre = $this->request->getPost('txt_nombre');
			$abreviatura = $this->request->getPost('txt_abreviatura');
			$categoria = $this->request->getPost('txt_categoria');
			$categorias = new ProveedoresCategorias();
			if($id_categ==""){
				$categorias = $categorias->insertarCategoria($nombre, $abreviatura, $categoria);
				echo json_encode(array('msg' => $id_categ));
			}else if($id_categ!=""){
				$categorias = $categorias->editarCategoria($id_categ, $nombre, $abreviatura, $categoria);
				echo json_encode(array('msg' => 'editado'));
			}
		}
	}
    public function eliminar(){
        $id_categoria=$this->request->getPost('id');
		$categorias=new ProveedoresCategorias();
		$categorias=$categorias->eliminarCategoria($id_categoria);
		echo json_encode(array("msg"=>"eliminado"));
    }
}
?>