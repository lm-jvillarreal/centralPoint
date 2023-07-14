<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIGrupo extends Model{

    public function listarGrupos(){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->select("id, id_Plan, id_periodo, nivel, id_docente");
        $grupos->where("ACTIVO",1);
        return $grupos->get()->getResultArray();
    }
    
    public function listarSelect($search){
        $grupos=$this->db->table("mCDIGrupos");
        if($search==""){
            $grupos->select("id, id_Plan, id_periodo, nivel, id_docente");
            $grupos->where("ACTIVO",1);
        }else{
            $grupos->select("id, id_Plan, id_periodo, nivel, id_docente");
            $grupos->where("activo",1);
            $grupos->like("id_Plan",$search);
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
    public function editarGrupo($id, $plan, $periodo, $nivel, $docente){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->set("id_Plan",$plan);
        $grupos->set("id_periodo",$periodo);
        $grupos->set("nivel",$nivel);
        $grupos->set("id_docente",$docente);
        $grupos->set("fechahora",date("Y-m-d H:i:s"));
        $grupos->where("id",$id);
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