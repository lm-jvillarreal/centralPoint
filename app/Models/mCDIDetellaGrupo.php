<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIDetalleGrupo extends Model{

    public function listarGrupo(){
        $detalle=$this->db->table("mCDIdetalle_grupo");
        $detalle->select("id, id_grupo, id_alumno");
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
        $grupos->set("id_periodo",$alumno);
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