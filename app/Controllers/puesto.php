<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use App\Models\Puestos;

class puesto extends BaseController{
    public function index(){

    }
    public function select(){
		$puestos=new Puestos();
		$searchTerm=$this->request->getPost('searchTerm');
		$puestos = $puestos->listarSelect($searchTerm);
		$data=array();
		foreach ($puestos as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['PUESTO']);
		}
		echo json_encode($data);
	}
}

?>