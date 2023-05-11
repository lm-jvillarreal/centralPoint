<?php
namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\PersonasTipos;
use CodeIgniter\HTTP\Response;

class personasTipo extends BaseController{
    public function select()
	{
		$tipos=new PersonasTipos();
		$searchTerm=$this->request->getPost('searchTerm');
		$tipos = $tipos->listarSelect($searchTerm);
		$data=array();
		foreach ($tipos as $resultado){
			$data[]=array("id"=>$resultado['ID'], "text"=>$resultado['TIPO']);
		}
		echo json_encode($data);
	}
}
?>