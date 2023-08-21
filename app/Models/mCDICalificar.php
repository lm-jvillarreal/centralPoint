<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDICalificar extends Model{

    public function listarEvaluacion() {
        $detalle = $this->db->table("mCDIEvaluaciones");
        $detalle->select("id, Nombre"); 
        $detalle->where("activo", 1);
        return $detalle->get()->getResultArray();
    }

    public function listarAlumno() {
        $detalle = $this->db->table("cfg_personas");
        $detalle->select("id");
        $detalle->select("CONCAT(NOMBRE, ' ', AP_PATERNO, ' ', AP_MATERNO) as id_alumno");
        $detalle->where("activo", 1);
        $detalle->where("TIPO_PERSONA", 3);
        return $detalle->get()->getResultArray();
    }
    public function insertarGrupo($plan, $periodo, $nivel, $docente){
        $grupos=$this->db->table("mCDIGrupos");
        $datos=[
            "id_Plan"=>$plan,
            "id_periodo"=>$periodo,
            "nivel"=>$nivel,
            "id_docente"=>$docente,
            "fechahora"=>date("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session("id_usuario")
        ];
        $grupos->insert($datos);
    }
    

}
?>