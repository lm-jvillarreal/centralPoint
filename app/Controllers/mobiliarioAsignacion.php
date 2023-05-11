<?php
namespace App\Controllers;

use App\Models\Departamentos;
use App\Models\Edificios;
use App\Models\MobiliarioAsignaciones;
use App\Models\Sedes;

 class mobiliarioAsignacion extends BaseController{
    public function index(){

    }
    public function listar(){
    $asignaciones = new MobiliarioAsignaciones();
    $asignaciones=$asignaciones->listarAsignaciones();
    $array=[];
    foreach($asignaciones as $resultado){
        array_push($array,[
        "id"=>$resultado["ID"],
        "inventario"=>$resultado["INVENTARIO"],
        "mobiliario"=>$resultado["MOBILIARIO"],
        "mobtipo"=>$resultado["MOBTIPO"],
        "sede"=>$resultado["SEDE"],
        "edificio"=>$resultado["EDIFICIO"],
        "departamento"=>$resultado["DEPARTAMENTO"],
        "fecha_asignacion"=>$resultado["FECHAHORA_ASIGNACION"],
        "nomenclatura"=>$resultado['NOMENCLATURA']
        ]);
    }
    echo json_encode($array);
    //print_r($asignaciones);
    }
    public function insertar(){
        if(!$this->validate([
            'txt_inventario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes ingresar un inventario'
                ]
            ],
            'txt_mobiliario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar un mobiliario'
                ]
            ],
            'txt_mobcategoria'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar una categoría'
                ]
            ],
            'txt_sede'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar una sede'
                ]
            ],
            'txt_edificio'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar un edificio'
                ]
            ],
            'txt_departamento'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Sebes seleccionar un departamento'
                ]
            ],
            'txt_responsable'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar un colaborador'
                ]
            ],
            'txt_consecutivo'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes asignar un consecutivo'
                ]
            ]
        ])){
            $inventario=$this->validator->getError("txt_inventario");
            $mobiliario=$this->validator->getError("txt_mobiliario");
            $mobcategoria=$this->validator->getError("txt_mobcategoria");
            $sede=$this->validator->getError("txt_sede");
            $edificio=$this->validator->getError("txt_edificio");
            $departamento=$this->validator->getError("txt_departamento");
            $responsable=$this->validator->getError("txt_responsable");
            $consecutivo=$this->validator->getError("txt_consecutivo");
            $errores=[
                "inventario"=>$inventario,
                "mobiliario"=>$mobiliario,
                "mobcategoria"=>$mobcategoria,
                "sede"=>$sede,
                "edificio"=>$edificio,
                "departamento"=>$departamento,
                "responsable"=>$responsable,
                "consecutivo"=>$consecutivo
            ];
            echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
        }else{
            $inventario=$this->request->getPost("txt_inventario");
            $mobiliario=$this->request->getPost("txt_mobiliario");
            $mobcategoria=$this->request->getPost("txt_mobcategoria");
            $sede=$this->request->getPost("txt_sede");
            $edificio=$this->request->getPost("txt_edificio");
            $departamento=$this->request->getPost("txt_departamento");
            $responsable=$this->request->getPost("txt_responsable");
            $consecutivo=$this->request->getPost("txt_consecutivo");
            
            //Obtenemos datos para nomenclatura
            $sedeDatos=new Sedes();
            $sedeDatos=$sedeDatos->datosSede($sede);
            $sedeAbreviatura=$sedeDatos[0]['ABREVIATURA'];

            $edificioDatos=new Edificios();
            $edificioDatos=$edificioDatos->datosEdificio($edificio);
            $edificioAbreviatura=$edificioDatos[0]['ABREVIATURA'];

            $departamentoDatos=new Departamentos();
            $departamentoDatos=$departamentoDatos->camposDepartamento($departamento);
            $departamentoAbreviatura=$departamentoDatos[0]['ABREVIATURA'];

            $nomenclatura="ISO ".$sedeAbreviatura." ".$edificioAbreviatura." ".$departamentoAbreviatura." ".$mobcategoria." ".$consecutivo;
            //$nomenclatura="";
            $mobiliarioAsignacion=new MobiliarioAsignaciones();
            $mobiliarioAsignacion=$mobiliarioAsignacion->insertarAsignacion($inventario, $mobiliario,$mobcategoria,$sede,$edificio,$departamento,$responsable,$consecutivo,$nomenclatura,'');
            echo json_encode(["msg" => "insertado"]);
        }
    }
 }
?>