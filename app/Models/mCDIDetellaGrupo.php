<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Grupos extends Model{
    public function listarDetalles(){
        $detalle=$this->db->table("mCDIdetalle_grupo AS D");
        $detalle->select("D.id, D.id_grupo, D.id_alumno");
        $detalle->select("(SELECT CONCAT(nombre) FROM mCDIGrupos WHERE id=D.id_grupo)");
        $detalle->select("(SELECT CONCAT(alumno) FROM mCDIAlumnos WHERE id=D.id_alumno)");
      
        return $detalle->get()->getResultArray();
    }
    public function listarSelect($search)
    {
        $detalle = $this->db->table("mCDIdetalle_grupo");
        if($search==""){
            $detalle->select('id,id_grupo,id_alumno');
            $detalle->where("activo",1);
        }
        else
        {
            $detalle->select('id,id_grupo,id_alumno');
            $detalle->where("activo",1);
            $detalle->like('id_grupo',$search);
        }
    }
    public function camposDetalle($id){
        $detalle=$this->db->table("mCDIdetalle_grupo AS D");
        $detalle->select("D.id, D.id_grupo, D.id_alumno");
        $detalle->select("(SELECT CONCAT(nombre) FROM mCDIGrupos WHERE id=D.id_grupo)");
        $detalle->select("(SELECT CONCAT(alumno) FROM mCDIAlumnos WHERE id=D.id_alumno)");
      
        return $detalle->get()->getResultArray();
    }
    public function insertarDetalle($nombre, $alumno,){
        $detalle=$this->db->table("mCDIdetalle_grupo");
        $datos=[
            "id_grupo"=>$nombre,
            "id_alumno"=>$alumno,
            "fechahora"=>date_time("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session('id_usuario')
        ];
        $grupos->insert($datos);
    }
    public function editarGrupos($id_detalle_grupo,$nombre,$alumno){
        $detalle=$this->db->table("mCDIdetalle_grupo");
        $detalle->set("id_grupo",$nombre);
        $detalle->set("id_alumno",$alumno);
        $detalle->set("fechahora",date_time("Y-m-d H:i:s"));
        $detalle->set("activo",1);
        $detalle->set("usuario",session('id_usuario'));
        $detalle->where("id",$id_grupo);
        $detalle->update();
    }
    public function eliminardetalle($id){
        $detalle=$this->db->table("mCDIdetalle_grupo");
        $detalle->set("activo",0);
        $detalle->where("id",$id);
    }

}

?>