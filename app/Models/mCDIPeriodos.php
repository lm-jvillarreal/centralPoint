<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIPeriodos extends Model{
    public function listarPeriodos(){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->select("id, periodo, fecha_inicio, fecha_fin");
        $periodos->where("activo",1);
        return $periodos->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$periodos = $this->db->table("mCDIPeriodos");
		if($search==""){
			$periodos->select('id,periodo');
			$periodos->where("activo",1);
		}else{
			$periodos->select('id,periodo');
			$periodos->where("activo",1);
			$periodos->like('periodo',$search);
		}
		return $periodos->get()->getResultArray();
	}
    public function camposPeriodo($id){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->select("id, periodo, fecha_inicio, fecha_fin");
        $periodos->where("P.id",$id);
        return $periodos->get()->getResultArray();
    }
    public function insertarPeriodo($periodo, $fecha_inicio, $fecha_fin){
        $periodos=$this->db->table("mCDIPeriodos");
        $datos=[
            "periodo"=>$periodo,
            "fecha_inicio"=>$fecha_inicio,
            "fecha_fin"=>$fecha_fin,
            "activo"=>1,
            "usuario"=>session('id_usuario')
        ];
        $periodos->insert($datos);
    }
    public function editarPeriodo($id_periodo,$periodo,$fecha_inicio,$fecha_fin){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->set("periodo",$periodo);
        $periodos->set("fecha_inicio",$fecha_inicio);
        $periodos->set("fecha_fin",$fecha_fin);
        $periodos->set("activo",1);
        $periodos->set("usuario",session('id'));
        $periodos->where("id",$id_periodo);
        $periodos->update();
    }
    public function eliminarPeriodo($id){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->set("activo",0);
        $periodos->where("id",$id);
        $periodos->update();
    }
}
?>