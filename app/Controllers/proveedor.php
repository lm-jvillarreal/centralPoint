<?php
namespace App\Controllers;
use App\Models\Proveedores;

class proveedor extends BaseController{
    public function index(){

    }
    public function listar(){
        $proveedores=new Proveedores();
        $proveedores=$proveedores->listar();
        $array=[];
        foreach($proveedores as $resultado){
            array_push($array,[
                "id"=>$resultado['ID'],
                "nombre"=>$resultado['NOMBRE'],
                "razon_social"=>$resultado['RAZON_SOCIAL'],
                "rfc"=>$resultado['RFC'],
                "telefono"=>$resultado['TELEFONO'],
                "email"=>$resultado['EMAIL']
            ]);
        }
        echo json_encode($array);
    }
    public function select(){
        $proveedores=new Proveedores();
		$searchTerm=$this->request->getPost('searchTerm');
		$proveedores = $proveedores->listarSelect($searchTerm);
		$data=[];
		foreach ($proveedores as $resultado){
			$data[]=["id"=>$resultado['ID'], "text"=>$resultado['NOMBRE']];
		}
		echo json_encode($data);
    }
    public function campos(){
        $proveedores=new Proveedores();
        $id_proveedor=$this->request->getPost('id');
        $proveedores=$proveedores->camposProveedor($id_proveedor);
        echo json_encode(
            [
                "id"=>$proveedores[0]['ID'],
                "nombre"=>$proveedores[0]['NOMBRE'],
                "razon_social" => $proveedores[0]['RAZON_SOCIAL'],
                "rfc" => $proveedores[0]['RFC'],
                "direccion" => $proveedores[0]['DIRECCION'],
                "telefono"=>$proveedores[0]['TELEFONO'],
                "email"=>$proveedores[0]['EMAIL'],
                "descripcion_proveedor"=>$proveedores[0]['DESCRIPCION_PROVEEDOR'],
                "id_categoria"=>$proveedores[0]['ID_CATEGORIA'],
                "categoria"=>$proveedores[0]['CATEGORIA']
            ]
        );
    }
    public function insertar(){
        {
            if (!$this->validate([
                'txt_nombre' => [
                    'rules' => 'required',
                    'errors' => [
                        "required" => "Debes ingresar un nombre"
                    ]
                ],
                'txt_razonsocial' => [
                    'rules' => 'required',
                    'errors' => [
                        "required" => "Debes ingresar una razón social"
                    ]
                ],
                'txt_rfc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes ingresar un RFC"
                    ]
                ],
                'txt_direccion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes ingresar una dirección"
                    ]
                ],
                'txt_telefono' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes ingresar un teléfono"
                    ]
                ],
                'txt_email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes ingresar un email"
                    ]
                ],
                'txt_categoria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes seleccionar una categoría"
                    ]
                ],
                'txt_descripcion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Debes seleccionar una descripción"
                    ]
                ]
            ])) {
                $nombre = $this->validator->getError('txt_nombre');
                $razon_social = $this->validator->getError('txt_razonsocial');
                $rfc = $this->validator->getError('txt_rfc');
                $direccion = $this->validator->getError('txt_direccion');
                $telefono = $this->validator->getError("txt_telefono");
                $email = $this->validator->getError('txt_email');
                $categoria = $this->validator->getError("txt_categoria");
                $descripcion = $this->validator->getError("txt_descripcion");
                $errores = [
                    'nombre' => $nombre,
                    'razon_social' => $razon_social,
                    'rfc' => $rfc,
                    'direccion' => $direccion,
                    'telefono' => $telefono,
                    'email' => $email,
                    'categoria_proveedor' => $categoria,
                    'descripcion_proveedor' => $descripcion
                ];
                echo json_encode($errores);
                $response = service('response');
    
                $response->setStatusCode(400);
                $response->setHeader('Content-type', 'text/html');
                $response->noCache();
                $response->send();
            } else {
                $id_proveedor = $this->request->getPost('id');
                $nombre = $this->request->getPost('txt_nombre');
                $razon_social = $this->request->getPost('txt_razonsocial');
                $rfc = $this->request->getPost('txt_rfc');
                $direccion = $this->request->getPost('txt_direccion');
                $telefono = $this->request->getPost('txt_telefono');
                $email = $this->request->getPost('txt_email');
                $categoria = $this->request->getPost('txt_categoria');
                $descripcion = $this->request->getPost('txt_descripcion');
                $proveedores = new Proveedores();
                if($id_proveedor==""){
                    $proveedores = $proveedores->insertarProveedor($nombre, $razon_social, $rfc, $direccion, $telefono, $email, $categoria, $descripcion);
                    echo json_encode(['msg' => 'insertado']);
                }else if($id_proveedor!=""){
                    $proveedores = $proveedores->editarProveedor($id_proveedor, $nombre, $razon_social, $rfc, $direccion, $telefono, $email, $categoria, $descripcion);
                    echo json_encode(['msg' => 'editado']);
                }
            }
        }
    }

    public function eliminar(){
        $id_proveedor=$this->request->getPost('id');
        $proveedores=new Proveedores();
        $proveedores=$proveedores->eliminarProveedores($id_proveedor);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>