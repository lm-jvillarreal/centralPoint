<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class Edificios extends Model{
    public function listarEdificios(){
        $edificios=$this->db->table("cfg_edificios");
        $edificios->select("ID, NOMBRE, ABREVIATURA");
        $edificios->where("ACTIVO",1);
        return $edificios->get()->getResultArray();
    }
    public function datosEdificio($id){
        $edificios=$this->db->table("cfg_edificios");
        $edificios->select("ID, NOMBRE, ABREVIATURA");
        $edificios->where("ID",$id);
        return $edificios->get()->getResultArray();
    }
    public function insertarEdificios($edificio, $abreviatura){
        $edificios=$this->db->table("cfg_edificios");
        $datos=[
            "NOMBRE"=>$edificio,
            "ABREVIATURA"=>$abreviatura,
            "HORA"=>date("H:i:s"),
            "FECHA"=>date("Y-m-d"),
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $edificios->insert($datos);
    }
    public function listarSelect($search)
	{
		$edificios = $this->db->table("cfg_edificios");
		if($search==""){
			$edificios->select('ID,NOMBRE');
			$edificios->where("ACTIVO",1);
		}else{
			$edificios->select('ID,NOMBRE');
			$edificios->where("ACTIVO",1);
			$edificios->like('NOMBRE',$search);
		}
		return $edificios->get()->getResultArray();
	}
    public function editarEdificios($id,$edificio,$abreviatura){
        $edificios=$this->db->table("cfg_edificios");
        $edificios->set("NOMBRE",$edificio);
        $edificios->set("ABREVIATURA",$abreviatura);
        $edificios->set("FECHA",date("Y-m-d"));
        $edificios->set("HORA",date("H:i:s"));
        $edificios->set("ACTIVO",1);
        $edificios->set("USUARIO",session('id_usuario'));
        $edificios->where("ID",$id);
        $edificios->update();
    }
    public function eliminarEdificios($id){
        $edificios=$this->db->table("cfg_edificios");
        $edificios->set("ACTIVO",0);
        $edificios->where("ID",$id);
        $edificios->update();

    }
}
?>