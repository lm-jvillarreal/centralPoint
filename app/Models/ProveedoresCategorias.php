<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class ProveedoresCategorias extends Model{
    public function listar(){
        $categorias=$this->db->table("af_tipoproveedor");
        $categorias->select("ID, NOMBRE, ABREVIATURA, CATEGORIA");
        $categorias->where("ACTIVO",1);
        return $categorias->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$categorias = $this->db->table("af_tipoproveedor");
		if($search==""){
			$categorias->select('ID,NOMBRE');
			$categorias->where("ACTIVO",1);
		}else{
			$categorias->select('ID,NOMBRE');
			$categorias->where("ACTIVO",1);
			$categorias->like('TIPO',$search);
		}
		return $categorias->get()->getResultArray();
	}
    public function insertarCategoria($nombre, $abreviatura, $categoria){
		$categorias=$this->db->table("af_tipoproveedor");
		$datos=[
			"NOMBRE"=>$nombre,
			"ABREVIATURA"=>$abreviatura,
            "CATEGORIA"=>$categoria,
			"FECHA"=>date("Y-m-d"),
            "HORA"=>date("H:i:s"),
			"ACTIVO"=>1,
			"USUARIO"=>session('id_usuario')
		];
		$categorias->insert($datos);
	}
    public function editarCategoria($id, $nombre, $abreviatura, $categoria){
        $categorias=$this->db->table("af_tipoproveedor");
        $categorias->set("NOMBRE",$nombre);
        $categorias->set("ABREVIATURA",$abreviatura);
        $categorias->set("CATEGORIA",$categoria);
        $categorias->set("FECHA",date("Y-m-d"));
        $categorias->set("HORA",date("H:i:s"));
        $categorias->set("ACTIVO",1);
        $categorias->set("USUARIO",session("id_usuario"));
        $categorias->where("ID",$id);
        $categorias->update();
    }
    public function eliminarCategoria($id){
        $categorias=$this->db->table("af_tipoproveedor");
        $categorias->set("ACTIVO",0);
        $categorias->where("ID",$id);
        $categorias->update();
    }
}
?>