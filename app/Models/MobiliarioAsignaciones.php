<?php
namespace App\Models;

use CodeIgniter\Model;

class MobiliarioAsignaciones extends Model{
    public function listarAsignaciones(){
        $asignaciones=$this->db->table("af_mobiliarioasignaciones as a");
        $asignaciones->select("a.ID, a.INVENTARIO");
        $asignaciones->select("(SELECT DESCRIPCION FROM af_mobiliario WHERE ID=a.ID_MOBILIARIO) AS MOBILIARIO");
        $asignaciones->select("(SELECT NOMBRE FROM af_mobiliariocategorias WHERE ID=a.ID_TIPOMOBILIARIO) AS MOBTIPO");
        $asignaciones->select("(SELECT NOMBRE FROM cfg_sedes WHERE ID=a.ID_SEDE) as SEDE");
        $asignaciones->select("(SELECT NOMBRE FROM cfg_edificios WHERE ID=a.ID_EDIFICIO) as EDIFICIO");
        $asignaciones->select("(SELECT NOMBRE FROM cfg_departamentos WHERE ID=a.ID_DEPARTAMENTO) as DEPARTAMENTO");
        $asignaciones->select("a.NOMENCLATURA, a.CONSECUTIVO, a.FECHAHORA_ASIGNACION");
        $asignaciones->where("a.ACTIVO",1);
        return $asignaciones->get()->getResultArray();
        //return $asignaciones->getCompiledSelect();
    }
    public function insertarAsignacion($inventario, $id_mobiliario, $id_tipomobiliario, $id_sede, $id_edificio, $id_departamento, $id_responsable, $consecutivo, $nomenclatura, $fechahora_asignacion){
        $asignaciones=$this->db->table("af_mobiliarioasignaciones");
        $datos=[
            "INVENTARIO"=>$inventario,
            "ID_MOBILIARIO"=>$id_mobiliario,
            "ID_TIPOMOBILIARIO"=>$id_tipomobiliario,
            "ID_SEDE"=>$id_sede,
            "ID_EDIFICIO"=>$id_edificio,
            "ID_DEPARTAMENTO"=>$id_departamento,
            "ID_RESPONSABLE"=>$id_responsable,
            "CONSECUTIVO"=>$consecutivo,
            "NOMENCLATURA"=>$nomenclatura,
            "FECHAHORA_ASIGNACION"=>$fechahora_asignacion,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $asignaciones->insert($datos);
    }
    public function eliminarAsignacion($id){
        $asignaciones=$this->db->table("af_mobiliarioasignaciones");
        $asignaciones->set("ACTIVO",0);
        $asignaciones->where("ID",$id);
        $asignaciones->update();
    }
}
?>