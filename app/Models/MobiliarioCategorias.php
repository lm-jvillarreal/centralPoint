<?php
namespace App\Models;

use CodeIgniter\Model;

class MobiliarioCategorias extends Model{
    public function listarCategorias(){
        $categorias=$this->db->table("af_mobiliariocategorias");
        $categorias->select("ID, NOMBRE, DESCRIPCION");
        $categorias->where("ACTIVO",1);
        return $categorias->get()->getResultArray();
    }

    public function listarSelect($search){
        $categorias=$this->db->table("af_mobiliariocategorias");
        if($search==""){
            $categorias->select("ID, NOMBRE");
            $categorias->where("ACTIVO",1);
        }else{
            $categorias->select("ID,NOMBRE");
            $categorias->where("ACTIVO",1);
            $categorias->like("NOMBRE",$search);
        }
        return $categorias->get()->getResultArray();
    }

    public function insertarCategoria($nombre, $descripcion){
        $categorias=$this->db->table("af_mobiliariocategorias");
        $datos=[
            "NOMBRE"=>$nombre,
            "DESCRIPCION"=>$descripcion,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $categorias->insert($datos);
    }

    public function editarCategoria($id, $nombre, $descripcion){
        $categorias=$this->db->table("af_mobiliariocategorias");
        $categorias->set("NOMBRE",$nombre);
        $categorias->set("DESCRIPCION",$descripcion);
        $categorias->set("FECHAHORA",date("Y-m-d H:i:s"));
        $categorias->where("ID",$id);
        $categorias->update();
    }

    public function eliminarCategoria($id){
        $categorias=$this->db->table("af_mobiliariocategorias");
        $categorias->set("ACTIVO",0);
        $categorias->where("ID",$id);
        $categorias->update();
    }
}
?>