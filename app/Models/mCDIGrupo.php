<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIGrupo extends Model{

    public function listarGrupos(){
        $grupos=$this->db->table("mCDIGrupos as G");
        $grupos->select("G.id, G.nivel, G.id_docente");
        $grupos->select("(SELECT nombre FROM mCDIPlanEstudios WHERE id=G.id_Plan) As id_Plan");
        $grupos->select("(SELECT periodo FROM mCDIPeriodos WHERE id=G.id_periodo) As id_periodo");
        $grupos->where("ACTIVO",1);
        return $grupos->get()->getResultArray();
    }
    
    public function listarSelect($search){
        $grupos=$this->db->table("mCDIGrupos");
        if($search==""){
            $grupos->select("id, Nombre");
            $grupos->where("ACTIVO",1);
        }else{
            $grupos->select("id, Nombre");
            $grupos->where("activo",1);
            $grupos->like("Nombre",$search);
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


    //Detalle
    public function listarGrupo(){
        $detalle=$this->db->table("mCDIdetalle_grupo");
        $detalle->select("id, id_alumno");
        $detalle->select("(SELECT nivel FROM mCDIGrupos WHERE id=id_grupo) AS id_grupo");
        $detalle->where("activo",1);
        return $detalle->get()->getResultArray();
    }
    public function listarSelects($search){
        $grupos=$this->db->table("mCDIdetalle_grupo");
        if($search==""){
            $grupos->select("id, id_grupo, id_alumno");
            $grupos->where("activo",1);
        }else{
            $grupos->select("id, id_grupo, id_alumno");
            $grupos->where("activo",1);
            $grupos->like("id_Plan",$search);
        }
        return $grupos->get()->getResultArray();
    }
    public function camposGrupo($id){
        $grupos=$this->db->table("mCDIdetalle_grupo");
        $grupos->select("id, id_grupo, id_alumno");
        $grupos->where("id",$id);
        return $grupos->get()->getResultArray();
    }


    public function insertarGrupos($grupo, $alumno){
        $grupos=$this->db->table("mCDIdetalle_grupo");
        $datos=[
            "id_grupo"=>$grupo,
            "id_alumno"=>$alumno,
            "fechahora"=>date("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session("id_usuario")
        ];
        $grupos->insert($datos);
    }
    public function editarGrup($id, $grupo, $alumno){
        $grupos=$this->db->table("mCDIdetalle_grupo");
        $grupos->set("id_grupo",$grupo);
        $grupos->set("id_alumno",$alumno);
        $grupos->set("fechahora",date("Y-m-d H:i:s"));
        $grupos->where("id",$id);
        $grupos->update();
    }

    public function eliminarGrupos($id){
        $grupos=$this->db->table("mCDIdetalle_grupo");
        $grupos->set("activo",0);
        $grupos->where("id",$id);
        $grupos->update();
    }

}




?>