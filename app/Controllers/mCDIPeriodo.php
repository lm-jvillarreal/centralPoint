<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\mCDIPeriodo;
use CodeIgniter\HTTP\Response;

class periodo extends BaseController{
    public function index(){
    }
    public function listar(){
        $periodos=new mCDIPeriodo();
        $periodos=$periodos->listarPeriodo();
        $data=[];
        foreach($periodos as $resultado){
            array_push($data,[
                "id"=>$resultado["id"],
                "periodo"=>$resultado["periodo"],
                "fecha_inicio"=>$resultado["fecha_inicio"],
                "fecha_fin"=>$resultado["fecha_fin"],
			]);
        }
        echo json_encode($data);
    }
    public function select()
	{
		$periodos=new mCDIPeriodo();
		$searchTerm=$this->request->getPost('searchTerm');
		$periodos = $periodos->listarSelect($searchTerm);
		$data=[];
		foreach ($periodos as $resultado){
			$data[]=["id"=>$resultado['id'], "text"=>$resultado['periodo']];
		}
		echo json_encode($data);
	}
    public function campos(){
        $periodos=new mCDIPeriodo();
        $id=$this->request->getPost('id');
        $periodos=$periodos->camposPeriodo($id);
        echo json_encode(
				[
					"id" => $periodos[0]['id'],
					"periodo" => $periodos[0]['periodo'],
					"fecha_inicio" => $periodos[0]['fecha_inicio'],
					"fecha_fin" => $periodos[0]['fecha_fin'],
				]
			);
    }
    public function insertar(){
        if (!$this->validate([
			'txt_periodo' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes ingresar un periodo"
				]
			],
            'txt_fecha_inicio' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar la fecha inicial del periodo"
				]
            ],
			'txt_fecha_fin' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes ingresar la fecha final del periodo"
				]
            ],
		])) {
			$periodo = $this->validator->getError('txt_periodo');
            $fecha_inicio = $this->validator->getError('txt_fecha_inicio');
			$fecha_fin = $this->validator->getError('txt_fecha_fin');
			$errores = [
				'periodo' => $periodo,
                'fecha_inicio'=>$fecha_inicio,
				'fecha_fin' => $fecha_fin,
			];
			echo json_encode($errores);
			$response = service('response');
			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id=$this->request->getPost('id');
			$periodo = $this->request->getPost('txt_periodo');
            $fecha_inicio = $this->request->getPost('txt_fecha_inicio');
			$fecha_fin = $this->request->getPost('txt_fecha_fin');
			$periodos = new Departamentos();
			if($id==""){
				$periodos = $periodos->insertarPeriodo($periodo,$fecha_inicio,$fecha_fin);
				echo json_encode(['msg' => 'insertado']);
			}else if($id!=""){
				$periodos = $periodos->editarPeriodo($id,$periodo,$fecha_inicio,$fecha_fin);
				echo json_encode(['msg' => 'editado']);
			}
		}
    }
    public function eliminar()
    {
        $periodos = new mCDIPeriodo();
        $id=$this->request->getPost('id');
        $periodos=$periodos->eliminarPeriodo($id);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>