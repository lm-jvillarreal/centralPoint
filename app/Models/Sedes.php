<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Sedes extends Model{
	public function listarSedes(){
		$sedes=$this->db->table("cfg_sedes");
		$sedes->select("ID, NOMBRE, DIRECCION, ABREVIATURA");
		$sedes->where("ACTIVO",1);
		return $sedes->get()->getResultArray();
	}
	public function datosSede($id){
		$sedes=$this->db->table("cfg_sedes");
		$sedes->select("ID, NOMBRE, DIRECCION, ABREVIATURA");
		$sedes->where("ID",$id);
		return $sedes->get()->getResultArray();
	}
    public function listarSelect($search)
	{
		$sedes = $this->db->table("cfg_sedes");
		if($search==""){
			$sedes->select('ID,NOMBRE');
			$sedes->where("ACTIVO",1);
		}else{
			$sedes->select('ID,NOMBRE');
			$sedes->where("ACTIVO",1);
			$sedes->like('NOMBRE',$search);
		}
		return $sedes->get()->getResultArray();
	}
	public function insertarSede($sede, $direccion){
		$sedes=$this->db->table("cfg_sedes");
		$datos=[
			"NOMBRE"=>$sede,
			"DIRECCION"=>$direccion,
			"FECHAHORA"=>date("Y-m-d H:i:s"),
			"ACTIVO"=>1,
			"USUARIO"=>session('id_usuario')
		];
		$sedes->insert($datos);
	}
	public function editarSede($id_sede, $sede, $direccion){
		$sedes=$this->db->table("cfg_sedes");
		$sedes->set("NOMBRE",$sede);
		$sedes->set("DIRECCION",$direccion);
		$sedes->set("FECHAHORA",date("Y-m-d H:i:s"));
		$sedes->set("ACTIVO",1);
		$sedes->set("USUARIO",session('id_usuario'));
		$sedes->where("ID",$id_sede);
		$sedes->update();
	}
	public function eliminarSede($id_sede){
		$sedes=$this->db->table("cfg_sedes");
		$sedes->where("ID",$id_sede);
		$sedes->delete();
	}
}
?>