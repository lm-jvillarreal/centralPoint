<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIGrupos;
use CodeIgniter\HTTP\Response;

class Grupos extends BaseController{
    public function index(){
    }
    public function listar(){
        $grupos=new Grupos();
        $grupos=$grupos->listarGrupos();
        $data=[];
        foreach($grupos as $resultado){
            array_push($data,[
                "id"=>$resultado["id"],
                "id_Plan"=>$resultado["nombre"],
                "id_periodo"=>$resultado["periodo"],
                "nivel"=>$resultado["nivel"],
                "id_docente"=>$resultado["docente"],
            ]);
        }
        echo json_encode($data);
    }
    public function select()
    {
        $grupos=new Grupos();
        $searchTerm=$this->request->getPost('id');
        $grupos = $grupos->listarSelect($searchTerm);
        $data=[];
        foreach ($grupos as $resultado){
            $data[]=["id"=>$resultado['id'], "text"=>$resultado['nombre']];
        }
        echo json_encode($data);
    }
    public function campos(){
        $grupos=new Grupos();
        $id_grupos=this->request->getPost('id');
        $grupos=$grupos->camposGrupos($id_grupos);
        echo json_encode(
            [
                "id" => $grupos[0]['id'],
                "id_Plan" => $grupos[0]['nombre'],
                "id_periodo" => $grupos[0]['periodo'],
                "nivel" => $grupos[0]['nivel'],
                "id_docente" => $grupos[0]['docente']
            ]
            );
    }
    public function insertar(){
        if (!$this->validate([
            'txt_id_plan' => [
                'rules' => 'required',
                'errors' => [
                    "required" => "Debes ingresar un Plan"
                ]
            ],
            'txt_id_periodo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Debes ingresar un Periodo"
                ]
            ],
            'txt_nivel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Debes ingresar un nivel"
                ]
            ],
            'txt_id_docente' => [
                'rules' => 'required',
                'errors' => [
                    'required'=> "Debes ingresar un Docente"
                ]
            ]
        ])){
            $nombre = $this->validator->getError();
            $periodo = $this->validator->getError();
            $nivel = $this->validator->getError();
            $docente = $this->validator->getError();
            $errores = [
                'nombre' => $nombre,
                'periodo'=>$periodo,
                'nivel'=> $nivel,
                'docente'=>$docente
            ];
            echo json_encode($errores);
            $response = service('response');

            $response->setStatusCode(400);
            $response->setHeader('Content-type','txt/html');
            $response->noCache();
            $response->send();
        }else{
            $id_grupos=$this->request->getPost('id');
            $nombre = $this->resquest->getPost('');
            $periodo = $this->request->getPost('');
            $nivel = $this->request->getPost('');
            $docente = $this->request->getPost('');
            $grupos = new Grupos();
            if($id_grupos==""){
                $grupos = $grupos->insertarGrupos($nombre,$periodo,$nivel,$docente);
                echo json_encode(['msg' => 'insertado']);
            }else if($id_grupos!=""){
                $grupos = $grupos->editarGrupos($id_grupos,$nombre,$periodo,$nivel,$docente);
                echo json_encode(['msg' => 'editado']);
            }
        }
    }
    public function eliminar()
    {
        $grupos = new Grupos();
        $id_grupos=$this->request->getPost('id');
        $grupos=$grupos->eliminarGrupos($id_grupos);
        echo json_encode(["msg"=>"eliminado"]);
    }
}

?>