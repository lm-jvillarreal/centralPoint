<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIDetalleGrupo;
use CodeIgniter\HTTP\Response;

class Grupos extends BaseController{
    public function index(){
    }
    public function listar(){
        $detalle=new Detalles();
        $detalle=$grupos->listarDetalles();
        $data=[];
        foreach($grupos as $resultado){
            array_push($data,[
                "id"=>$resultado["id"],
                "id_grupo"=>$resultado["nombre"],
                "id_alumno"=>$resultado["alumno"],
                
            ]);
        }
        echo json_encode($data);
    }
    public function select()
    {
        $detalle=new Detalles();
        $searchTerm=$this->request->getPost('id');
        $detalle = $grupos->listarSelect($searchTerm);
        $data=[];
        foreach ($detalle as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nombre']];
        }
        echo json_encode($data);
    }
    public function campos(){
        $detalle=new Detalles();
        $id_grupos=this->request->getPost('id');
        $detalle=$detalle->camposDetalles($id_detalle_grupo);
        echo json_encode(
            [
                "id" => $detalle[0]['id'],
                "id_grupo" => $detalle[0]['nombre'],
                "id_alumno" => $detalle[0]['alumno'],
               
            ]
            );
    }
    public function insertar(){
        if (!$this->validate([
            'txt_id_grupo' => [
                'rules' => 'required',
                'errors' => [
                    "required" => "Debes ingresar un Plan"
                ]
            ],
            'txt_id_alumno' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Debes ingresar un Periodo"
                ]
            ]
        ])){
            $nombre = $this->validator->getError();
            $alumno = $this->validator->getError();
           
            $errores = [
                'nombre' => $nombre,
                'periodo'=>$alumno,
                
            ];
            echo json_encode($errores);
            $response = service('response');

            $response->setStatusCode(400);
            $response->setHeader('Content-type','txt/html');
            $response->noCache();
            $response->send();
        }else{
            $id_detalle_grupo=$this->request->getPost('id');
            $nombre = $this->resquest->getPost('');
            $alumno = $this->request->getPost('');
            $grupos = new Detalles();
            if($id_detalle_grupo==""){
                $detalle = $detalle->insertarDetalles($nombre,$alumno);
                echo json_encode(['msg' => 'insertado']);
            }else if($id_detalle_grupo!=""){
                $grupos = $grupos->editarGrupos($id_detalle_grupo,$nombre,$alumno);
                echo json_encode(['msg' => 'editado']);
            }
        }
    }
    public function eliminar()
    {
        $detalle = new Detalles();
        $id_detalle_grupo=$this->request->getPost('id');
        $detalle=$detalle->eliminarDetalle($id_detalle_grupo);
        echo json_encode(["msg"=>"eliminado"]);
    }
}

?>