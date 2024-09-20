<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class Puestos extends Model{
    public function listarPuestos(){
        $puestos=$this->db->table("cfg_puestos");
        $puestos->select("ID, PUESTO, DESCRIPCION");
        $puestos->where("ACTIVO",1);
        return $puestos->get()->getResultArray();

        //esta linea me sirve para imprimir la consulta
        //return $puestos->getCompiledSelect();
    }
    public function listarSelect($search){
        $puestos = $this->db->table("cfg_puestos");
        if($search==""){
            $puestos->select("ID,PUESTO");
            $puestos->where("ACTIVO",1);
        }else{
            $puestos->select("ID,PUESTO");
            $puestos->where("ACTIVO",1);
            $puestos->like("PUESTO",$search);
        }
        return $puestos->get()->getResultArray();
    }
    public function insertarPuesto($puesto, $descripcion){
        $puestos=$this->db->table("cfg_puestos");
        $datos=[
            "PUESTO"=>$puesto,
            "DESCRIPCION"=>$descripcion,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $puestos->insert($datos);
    }
    public function editarPuesto($id, $puesto, $descripcion){
        $puestos=$this->db->table("cfg_puestos");
        $puestos->set("PUESTO",$puesto);
        $puestos->set("DESCRIPCION",$descripcion);
        $puestos->set("FECHAHORA",date("Y-m-d H:i:s"));
        $puestos->where("ID",$id);
        $puestos->update();
    }
    public function eliminarPuesto($id){
        $puestos=$this->db->table("cfg_puestos");
        $puestos->set("ACTIVO",0);
        $puestos->where("ID",$id);
        $puestos->update();
    }
}
?>