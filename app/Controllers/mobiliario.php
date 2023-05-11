<?php
namespace App\Controllers;
use App\Models\Mobiliarios;

class mobiliario extends BaseController{
    public function index(){

    }
    public function listar(){
        $mobiliario=new Mobiliarios();
        $mobiliario=$mobiliario->listarMobiliario();
        $array=[];
        foreach($mobiliario as $resultado){
            array_push($array,[
                "id"=>$resultado["ID"],
                "marca"=>$resultado["MARCA"],
                "modelo"=>$resultado['MODELO'],
                "no_serie"=>$resultado['NUMERO_SERIE'],
                "descripcion"=>$resultado['DESCRIPCION'],
                "categoria"=>$resultado['MOBCATEGORIA']
            ]);
        }
        echo json_encode($array);
    }

    public function select(){
        $mobiliario=new Mobiliarios();
        $searchTerm=$this->request->getPost("searchTerm");
        $mobiliario=$mobiliario->listarSelect($searchTerm);
        $data=[];
        foreach($mobiliario as $resultado){
            $data[]=["id"=>$resultado["ID"], "text"=>$resultado["DESCRIPCION"]];
        }
        echo json_encode($data);
    }

    public function campos(){
        $mobiliario=new Mobiliarios();
        $id_mobiliario=$this->request->getPost('id');
        $mobiliario=$mobiliario->camposMobiliario($id_mobiliario);
        echo json_encode([
            "id"=>$mobiliario[0]["ID"],
            "inventario"=>$mobiliario[0]["INVENTARIO"],
            "marca"=>$mobiliario[0]["MARCA"],
            "modelo"=>$mobiliario[0]["MODELO"],
            "numero_serie"=>$mobiliario[0]["NUMERO_SERIE"],
            "descripcion"=>$mobiliario[0]["DESCRIPCION"],
            "otros_datos"=>$mobiliario[0]["OTROS_DATOS"],
            "categoria"=>$mobiliario[0]["ID_MOBCATEGORIA"],
            "nombre_categoria"=>$mobiliario[0]["MOBCATEGORIA"]
        ]);
    }
    
    public function insertar(){
        if(!$this->validate([
                'txt_inventario'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes asignar un número de inventario'
                    ]
                ],
                'txt_marca'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes escribir una marca'
                    ]
                ],
                'txt_modelo'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes escribir un modelo'
                    ]
                ],
                'txt_numeroserie'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes escribir un número de serie'
                    ]
                ],
                'txt_descripcion'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes escribir una descripción'
                    ]
                ],
                'txt_otrosdatos'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Debes complementar la información'
                    ]
                ],
                'txt_mobcategoria'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>"Debes seleccionar una categoría"
                    ]
                ]
        ])){
            $inventario=$this->validator->getError('txt_inventario');
            $marca=$this->validator->getError('txt_marca');
            $modelo=$this->validator->getError('txt_modelo');
            $numero_serie =$this->validator->getError('txt_numeroserie');
            $descripcion=$this->validator->getError('txt_descripcion');
            $otros_datos=$this->validator->getError('txt_otrosdatos');
            $id_mobcategoria=$this->validator->getError('txt_mobcategoria');
            $errores=[
                'inventario'=>$inventario,
                'marca'=>$marca,
                'modelo'=>$modelo,
                'numero_serie'=>$numero_serie,
                'descripcion'=>$descripcion,
                'otros_datos'=>$otros_datos,
                'mobiliario_categoria'=>$id_mobcategoria
            ];
            echo json_encode($errores);
			$response = service('response');
			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
        }else{
            $id_mobiliario=$this->request->getPost('id');
            $inventario=$this->request->getPost('txt_inventario');
            $marca=$this->request->getPost('txt_marca');
            $modelo=$this->request->getPost('txt_modelo');
            $numero_serie=$this->request->getPost('txt_numeroserie');
            $descripcion=$this->request->getPost('txt_descripcion');
            $otros_datos=$this->request->getPost('txt_otrosdatos');
            $id_mobcategoria=$this->request->getPost('txt_mobcategoria');
            $mobiliario=new Mobiliarios();
            if($id_mobiliario==""){
                $mobiliario=$mobiliario->insertarMobiliario($inventario,$marca,$modelo,$numero_serie,$descripcion,$otros_datos,$id_mobcategoria,"","");
                echo json_encode(['msg' => 'insertado']);
                //echo $mobiliario;
            }else if($id_mobiliario!=""){
                $mobiliario=$mobiliario->editarMobiliario($id_mobiliario, $inventario, $marca,$modelo ,$numero_serie,$descripcion,$otros_datos,$id_mobcategoria,"","");
                echo json_encode(["msg"=>"editado"]);
                //echo $mobiliario;
                //echo "hola";
            }
        }
    }
    public function eliminar(){
        $mobiliario=new Mobiliarios();
        $id_mobiliario=$this->request->getPost('id');
        $mobiliario=$mobiliario->eliminarMobiliario($id_mobiliario);
        echo json_encode(['msg'=>'eliminado']);
    }
}
?>