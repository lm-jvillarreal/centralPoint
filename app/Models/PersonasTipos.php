<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class PersonasTipos extends Model{
    public function listarSelect($search)
	{
		$tipos = $this->db->table("cfg_personastipo");
		if($search==""){
			$tipos->select('ID,TIPO');
			$tipos->where("ACTIVO",1);
		}else{
			$tipos->select('ID,TIPO');
			$tipos->where("ACTIVO",1);
			$tipos->like('TIPO',$search);
		}
		return $tipos->get()->getResultArray();
	}
}
?>