<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;
class Colaboradores extends Model{
    public function listarColaboradores(){
        $colaboradores=$this->db->table("cfg_colaboradores AS C");
        $colaboradores->select("C.ID, C.NUM_EMPLEADO");
        $colaboradores->select("(SELECT CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) FROM cfg_personas WHERE ID=C.ID_PERSONA) AS Persona");
        $colaboradores->select("(SELECT NOMBRE FROM cfg_sedes WHERE ID=C.ID_SEDE) AS Sede");
        $colaboradores->select("(SELECT NOMBRE FROM cfg_departamentos WHERE ID=C.ID_DEPARTAMENTO) AS Depto");
        $colaboradores->select("(SELECT PUESTO FROM cfg_puestos WHERE ID=C.ID_PUESTO) AS Puesto");
        $colaboradores->select("(SELECT TIPO FROM cfg_personastipo WHERE ID=C.TIPO_PERSONA) AS Tipo_persona");
        return $colaboradores->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$colaboradores = $this->db->table("cfg_colaboradores as C");
		if($search==""){
			$colaboradores->select("P.ID,CONCAT( P.NOMBRE, ' ', P.AP_PATERNO, ' ', P.AP_MATERNO ) AS COLABORADOR");
			$colaboradores->JOIN("cfg_personas AS P","C.ID_PERSONA = P.ID");
            $colaboradores->where("C.ACTIVO",1);
		}else{
			$colaboradores->select("P.ID,CONCAT( P.NOMBRE, ' ', P.AP_MATERNO, ' ', P.AP_MATERNO ) AS COLABORADOR");
			$colaboradores->JOIN("cfg_personas AS P","C.ID_PERSONA = P.ID");
            $colaboradores->where("C.ACTIVO",1);
			$colaboradores->like("CONCAT( P.NOMBRE, ' ', P.AP_MATERNO, ' ', P.AP_MATERNO )",$search);
		}
		return $colaboradores->get()->getResultArray();
	}
    public function camposColaborador($id){
        $colaboradores=$this->db->table("cfg_colaboradores AS C");
        $colaboradores->select("C.ID, C.NUM_EMPLEADO, C.ID_PERSONA, C.ID_SEDE, C.ID_DEPARTAMENTO, C.ID_PUESTO, C.TIPO_PERSONA");
        $colaboradores->select("(SELECT CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) FROM cfg_personas WHERE ID=C.ID_PERSONA) AS PERSONA");
        $colaboradores->select("(SELECT NOMBRE FROM cfg_sedes WHERE ID=C.ID_SEDE) AS SEDE");
        $colaboradores->select("(SELECT NOMBRE FROM cfg_departamentos WHERE ID=C.ID_DEPARTAMENTO) AS DEPARTAMENTO");
        $colaboradores->select("(SELECT PUESTO FROM cfg_puestos WHERE ID=C.ID_PUESTO) AS PUESTO");
        $colaboradores->select("(SELECT TIPO FROM cfg_personastipo WHERE ID=C.TIPO_PERSONA) AS TIPO_PERSONA");
        $colaboradores->where("C.ID",$id);
        return $colaboradores->get()->getResultArray();
    }
    public function insertarColaborador($persona, $no_empleado, $departamento, $puesto, $sede, $tipo_persona){
        $colaboradores=$this->db->table("cfg_colaboradores");
        $datos=[
            "NUM_EMPLEADO"=>$no_empleado,
            "ID_PERSONA"=>$persona,
            "ID_SEDE"=>$sede,
            "ID_PERIODO"=>'',
            "ID_DEPARTAMENTO"=>$departamento,
            "ID_PUESTO"=>$puesto,
            "TIPO_PERSONA"=>$tipo_persona,
            "FECHA_INGRESO"=>'',
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $colaboradores->insert($datos);
    }
    public function editarColaborador($id_colaborador, $persona, $no_empleado, $departamento, $puesto, $sede, $tipo_persona){
        $colaborador=$this->db->table("cfg_colaboradores");
        $colaborador->set('ID_PERSONA',$persona);
        $colaborador->set('NUM_EMPLEADO',$no_empleado);
        $colaborador->set('ID_DEPARTAMENTO',$departamento);
        $colaborador->set('ID_PUESTO',$puesto);
        $colaborador->set('ID_SEDE',$sede);
        $colaborador->set('TIPO_PERSONA',$tipo_persona);
        $colaborador->where("ID",$id_colaborador);
        $colaborador->update();
    }
    public function eliminarColaborador($id_colaborador){
        $colaborador=$this->db->table("cfg_colaboradores");
        $colaborador->set("ACTIVO",0);
        $colaborador->where("ID",$id_colaborador);
        $colaborador->update();
    }
}
?>
