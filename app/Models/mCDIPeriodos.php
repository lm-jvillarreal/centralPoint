<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Periodos extends Model{
    public function listarPeriodos(){
        $periodos=$this->db->table("mCDIPeriodos AS P");
        $periodos->select("P.id, D.clave, P.nombre");
        $periodos->select("(SELECT periodo,' ', FROM mCDIPeriodos");
        return $periodos->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$periodos = $this->db->table("mCDIPeriodos");
		if($search==""){
			$periodos->select('id,period');
			$periodos->where("activo",1);
		}else{
			$periodos->select('id,periodo');
			$periodos->where("activo",1);
			$periodos->like('periodo',$search);
		}
		return $periodos->get()->getResultArray();
	}
    public function camposPeriodo($id){
        $periodos=$this->db->table("mCDIPeriodos AS P");
        $periodos->select("P.id, P.periodo, P.fecha_inicio, P.fecha_fin");
        $periodos->select("(SELECT periodo,' ',fecha_inicio,' ',fecha_fin FROM mCDIPeriodos");
        $periodos->where("P.ID",$id);
        return $periodos->get()->getResultArray();
    }
    public function insertarPeriodo($periodos, $fecha_inicio, $fecha_fin){
        $periodos=$this->db->table("mCDIPeriodos");
        $datos=[
            "periodo"=>$periodo,
            "fecha_inicio"=>date("Y-m-d"),
            "fecha_fin"=>date("Y-m-d"),
            "activo"=>1,
            "usuario"=>session('id_usuario')
        ];
        $periodos->insert($datos);
    }
    public function editarPeriodo($id,$periodo, $fecha_inicio, $fecha_fin){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->set("periodo",$periodo);
        $periodos->set("fecha_inicio",date("Y-m-d"));
        $periodos->set("fecha_fin",date("Y-m-d"));
        $periodos->set("activo",1);
        $periodos->set("usuario",session('id'));
        $periodos->where("id",$id);
        $periodos->update();
    }
    public function eliminarPeriodo($id){
        $periodos=$this->db->table("mCDIPeriodos");
        $periodos->set("activo",0);
        $periodos->where("id",$id);
    }
}
?>