<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDICalificar extends Model{

    public function listardetalle(){
        $grupos = $this->db->table("mCDIdetalle_evaluacion as G");
        $grupos->select("G.id, G.id_alumno, G.calificacion, (SELECT id_evaluacion FROM mCDIEvaluaciones WHERE id = G.id_evaluacion) AS id_evaluacion");
        $grupos->where("ACTIVO", 1);
        return $grupos->get()->getResultArray();
    }
    public function listarSelect1($search){
        $grupos=$this->db->table("mCDIEvaluaciones");
        if($search==""){
            $grupos->select("id, nombre");
            $grupos->where("activo",1);
        }else{
            $grupos->select("id, nombre");
            $grupos->where("activo",1);
            $grupos->like("nombre",$search);
        }
        return $grupos->get()->getResultArray();
    }
    

}
