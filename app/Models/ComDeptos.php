<?php
namespace App\Models;

use CodeIgniter\Model;

class ComDeptos extends Model{
    public function listarDepartamentos(){
        $departamentos=$this->db->table("COM_DEPTOS");
        $departamentos->select("ID, CVE_DEPTO, DESCRIPCION_DEPTO");
        $departamentos->where("ACTIVO",1);
        return $departamentos->get()->getResultArray();
    }

    public function listarSelect($search){
        $departamentos=$this->db->table("COM_DEPTOS");
        if($search==""){
            $departamentos->select("ID, CONCAT(CVE_DEPTO,' ',DESCRIPCION_DEPTO)");
            $departamentos->where("CONCAT(CVE_DEPTO,' ',DESCRIPCION_DEPTO)",1);
        }else{
            $departamentos->select("ID, CONCAT(CVE_DEPTO,' ',DESCRIPCION_DEPTO)");
            $departamentos->where("ACTIVO",1);
            $departamentos->like("CONCAT(CVE_DEPTO,' ',DESCRIPCION_DEPTO)",$search);
        }
        return $departamentos->get()->getResultArray(); 
    }

    public function insertarDepartamento($clave, $descripcion){
        $departamentos=$this->db->table("COM_DEPTOS");
        $datos=[
            "CVE_DEPTO"=>$clave,
            "DESCRIPCION_DEPTO"=>$descripcion,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $departamentos->insert($datos);
    }

    public function editarDepartamento($id, $nombre, $descripcion){
        $categorias=$this->db->table("COM_DEPTOS");
        $categorias->set("CVE_DEPTO",$nombre);
        $categorias->set("DESCRIPCION_DEPTO",$descripcion);
        $categorias->set("FECHAHORA",date("Y-m-d H:i:s"));
        $categorias->where("ID",$id);
        $categorias->update();
    }

    public function eliminarDepartamento($id){
        $categorias=$this->db->table("COM_DEPTOS");
        $categorias->set("ACTIVO",0);
        $categorias->where("ID",$id);
        $categorias->update();
    }
}
?>