<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIGrupo extends Model{

    public function listarGrupos(){
        $grupos=$this->db->table("mCDIGrupos as G");
        $grupos->select("G.id, G.nivel");
        $grupos->select("(SELECT nombre FROM mCDIPlanEstudios WHERE id=G.id_Plan) As id_Plan");
        $grupos->select("(SELECT periodo FROM mCDIPeriodos WHERE id=G.id_periodo) As id_periodo");
        $grupos->select("(SELECT CONCAT(NOMBRE, ' ', AP_PATERNO, ' ', AP_mATERNO) FROM cfg_personas WHERE id = id_docente) AS id_docente");
        $grupos->where("ACTIVO",1);
        return $grupos->get()->getResultArray();
    }
    
    public function listarSelect1($search){
        $grupos=$this->db->table("mCDIPlanEstudios");
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
    public function listarSelect2($search){
        $grupos=$this->db->table("mCDIPeriodos");
        if($search==""){
            $grupos->select("id, periodo");
            $grupos->where("activo",1);
        }else{
            $grupos->select("id, periodo");
            $grupos->where("activo",1);
            $grupos->like("periodo",$search);
        }
        return $grupos->get()->getResultArray();
    }
   
public function listarSelect3($search) {
    

    $grupos = $this->db->table("cfg_personas");

    if ($search == "") {
        $grupos->select("id, NOMBRE, AP_PATERNO, AP_mATERNO");
        $grupos->where("activo", 1);
        $grupos->where("TIPO_PERSONA", 2); 
    } else {
        $grupos->select("id, NOMBRE, AP_PATERNO, AP_mATERNO");
        $grupos->where("activo", 1);
        $grupos->where("TIPO_PERSONA", 2); 
        $grupos->like("NOMBRE", $search);
        $grupos->orLike("AP_PATERNO", $search);
        $grupos->orLike("AP_mATERNO", $search);
    }

    return $grupos->get()->getResultArray();
}

    
    public function camposGrupos($id){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->select("id, id_Plan, id_periodo, nivel, id_docente");
        $grupos->where("id",$id);
        return $grupos->get()->getResultArray();
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
    public function editarGrupo($id_grupo, $plan, $periodo, $nivel, $docente){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->set("id_Plan",$plan);
        $grupos->set("id_periodo",$periodo);
        $grupos->set("nivel",$nivel);
        $grupos->set("id_docente",$docente);
        $grupos->set("fechahora",date("Y-m-d H:i:s"));
        $grupos->where("id",$id_grupo);
        $grupos->update();
    }

    public function eliminarGrupo($id){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->set("activo",0);
        $grupos->where("id",$id);
        $grupos->update();
    }


    
}




?>