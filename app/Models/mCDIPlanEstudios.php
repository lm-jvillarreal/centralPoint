<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class PlanEstudios extends Model{
    public function listarPlanEstudios(){
        $planestudios=$this->db->table("mCDIPlanEstudios");
        $planestudios->select("Select id, clave, nombre FROM mCDIPlanEstudios");
        return $planestudios->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$planestudios = $this->db->table("mCDIPlanEstudios");
		if($search==""){
			$planestudios->select('id,nombre,clave');
			$planestudios->where("activo",1);
		}else{
			$planestudios->select('id,nombre,clave');
			$planestudios->where("activo",1);
			$planestudios->like('nombre',$search);
		}
		return $planestudios->get()->getResultArray();
	}
    public function camposPlanEstudio($id){
        $planestudios=$this->db->table("mCDIPlanEstudios");
        $planestudios->select("id, clave, nombre");
        $planestudios->where("id",$id);
        return $planestudios->get()->getResultArray();
    }
    public function insertarPlanEstudio($clave, $nombre){
        $planestudios=$this->db->table("mCDIPlanEstudios");
        $datos=[
            "clave"=>$clave,
            "nombre"=>$nombre,
            "fechahora"=>datetime("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session('id_usuario')
        ];
        $planestudios->insert($datos);
    }
    public function editarPlanEstudio($id_planestudio,$nombre, $clave){
        $planestudios=$this->db->table("mCDIPlanEstudios");
        $planestudios->set("clave",$clave);
        $planestudios->set("nombre",$clave);
        $planestudios->set("fechahora",date("Y-m-d H:i:s"));
        $planestudios->set("activo",1);
        $planestudios->set("usuario",session('id_usuario'));
        $planestudios->where("id",$id_planestudio);
        $planestudios->update();
    }
    public function eliminarPlanEstudio($id){
        $planestudios=$this->db->table("mCDIPlanEstudios");
        $planestudios->set("activo",0);
        $planestudios->where("id",$id);
    }
}
?>