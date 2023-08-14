<?php

namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIEvaluacion extends Model{

    public function listarGrupos(){
        
        $grupos=$this->db->table("mCDIEvaluaciones ");
        $grupos->select("id, nombre");
        $grupos->select("(SELECT tipo FROM mCDItipo_evaluacion WHERE id=tipo_evaluacion) As tipo_evaluacion");
        $grupos->where("ACTIVO",1);
        return $grupos->get()->getResultArray();
    }
    
    public function listarSelect1($search){
        $grupos=$this->db->table("mCDIGrupos");
        if($search==""){
            $id_usuario = session("id_usuario");
            $grupos->select("id, nivel");
            $grupos->where("activo",1);
            $grupos->where("usuario", $id_usuario);
        }else{
            $id_usuario = session("id_usuario");
            $grupos->select("id, nivel");
            $grupos->where("activo",1);
            $grupos->where("usuario", $id_usuario);
            $grupos->like("nivel",$search);
        }
        return $grupos->get()->getResultArray();
    }
    public function listarSelect2($search){
        $grupos=$this->db->table("mCDItipo_evaluacion");
        if($search==""){
            $grupos->select("id, tipo");
            $grupos->where("activo",1);
        }else{
            $grupos->select("id, tipo");
            $grupos->where("activo",1);
            $grupos->like("tipo",$search);
        }
        return $grupos->get()->getResultArray();
    }
   


    
    public function camposGrupos($id){
        $grupos=$this->db->table("mCDIEvaluaciones");
        $grupos->select("id, nombre, tipo_evaluacion");
        $grupos->where("id",$id);
        return $grupos->get()->getResultArray();
    }


    public function insertarGrupo($Grupo, $Nombre, $TipoEvaluacion){
        $grupos=$this->db->table("mCDIEvaluaciones");
        $datos=[
            "id_grupo"=>$Grupo,
            "nombre"=>$Nombre,
            "tipo_evaluacion"=>$TipoEvaluacion,
            "fechahora"=>date("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session("id_usuario")
        ];
        $grupos->insert($datos);
    }
    public function editarGrupo($id_eva, $Grupo, $Nombre, $TipoEvaluacion){
        $grupos=$this->db->table("mCDIEvaluaciones");
        $grupos->set("id_grupo",$Grupo);
        $grupos->set("nombre",$Nombre);
        $grupos->set("tipo_evaluacion",$TipoEvaluacion);
        $grupos->set("fechahora",date("Y-m-d H:i:s"));
        $grupos->where("id",$id_eva);
        $grupos->update();
    }

    public function eliminarGrupo($id){
        $grupos=$this->db->table("mCDIEvaluaciones");
        $grupos->set("activo",0);
        $grupos->where("id",$id);
        $grupos->update();
    }


    
}




?>