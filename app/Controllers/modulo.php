<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Modulos;
use CodeIgniter\HTTP\Response;

class modulo extends BaseController
{
    public function index(){
    }
    public function listar(){
        $modulos=new Modulos();
        $modulos=$modulos->listarModulos();
        $array=[];
        foreach ($modulos as $resultado) {
			array_push($array, [
				"id" => $resultado['ID'],
				"nombre" => $resultado['NOMBRE'],
        "ruta" => $resultado['RUTA'],
				"descripcion" => $resultado['DESCRIPCION'],
        "categoria" => $resultado['CATEGORIA'],
        "icono" => $resultado['ICONO'],
        "tema" => $resultado['TEMA'],
				"opciones" => ""
			]);
		}
		echo json_encode($array);
    }
	public function select()
	{
		$modulos=new Modulos();
		$searchTerm=$this->request->getPost('searchTerm');
		$modulos = $modulos->listarSelect($searchTerm);
		$data=[];
		foreach ($modulos as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
		}
		echo json_encode($data);
	}
    public function campos(){
        $modulos=new Modulos();
        $id_modulo=$this->request->getPost('id');
        $modulos=$modulos->camposModulo($id_modulo);
        echo json_encode(
				[
					"id" => $modulos[0]['ID'],
					"modulo" => $modulos[0]['NOMBRE'],
					"ruta" => $modulos[0]['RUTA'],
					"descripcion" => $modulos[0]['DESCRIPCION'],
					"categoria" => $modulos[0]['CATEGORIA'],
					"nombre_categoria"=>$modulos[0]['NOMBRE_CATEGORIA'],
					"icono" => $modulos[0]['ICONO'],
					"tema" => $modulos[0]['TEMA']
				]
            );
    }
    public function insertar(){
        if (!$this->validate([
			'txt_modulo' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un nombre"
				]
			],
            'txt_ruta' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una ruta"
				]
            ],
			'txt_descripcion' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una descripción"
				]
            ],
            'txt_categoria' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar una categoría"
				]
            ],
            'txt_icono' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar una ícono"
				]
            ],
            'txt_tema' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un tema"
				]
			]

		])) {
			$modulo = $this->validator->getError('txt_modulo');
            $ruta = $this->validator->getError('txt_ruta');
			$descripcion = $this->validator->getError('txt_descripcion');
            $categoria = $this->validator->getError('txt_categoria');
            $icono = $this->validator->getError('txt_icono');
            $tema = $this->validator->getError('txt_tema');
			$errores = [
				'modulo' => $modulo,
                'ruta'=>$ruta,
				'descripcion' => $descripcion,
                'categoria'=>$categoria,
                'icono'=>$icono,
                'tema'=>$tema
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_modulo=$this->request->getPost('id');
			$modulo = $this->request->getPost('txt_modulo');
            $ruta = $this->request->getPost('txt_ruta');
			$descripcion = $this->request->getPost('txt_descripcion');
            $categoria = $this->request->getPost('txt_categoria');
            $icono = $this->request->getPost('txt_icono');
            $tema = $this->request->getPost('txt_tema');
			$modulos = new Modulos();
			if($id_modulo==""){
				$modulos = $modulos->insertarModulo($modulo, $ruta, $descripcion, $categoria, $icono, $tema);
				echo json_encode(['msg' => "insertado"]);
			}else if($id_modulo!=""){
				$modulos = $modulos->editarModulo($id_modulo, $modulo, $ruta, $descripcion, $categoria, $icono, $tema);
				echo json_encode(['msg' => 'editado',"modulo"=>$id_modulo]);
			}
		}
    }
    public function eliminar()
    {
        $modulos = new Modulos();
        $id_modulo=$this->request->getPost('id');
        $modulos=$modulos->eliminarModulo($id_modulo);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>