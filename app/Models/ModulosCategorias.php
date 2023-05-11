<?php

namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class ModulosCategorias extends Model
{
	public function listarCategorias()
	{
		$categorias = $this->db->table("cfg_moduloscategoria");
		$categorias->select("*");
		$categorias->where("ACTIVO", 1);
		return $categorias->get()->getResultArray();
	}
	public function listarSelect($search)
	{
		$categorias = $this->db->table("cfg_moduloscategoria");
		if($search==""){
			$categorias->select('ID,NOMBRE');
			$categorias->where("ACTIVO",1);
		}else{
			$categorias->select('ID,NOMBRE');
			$categorias->where("ACTIVO",1);
			$categorias->like('NOMBRE',$search);
		}
		return $categorias->get()->getResultArray();
	}
	public function insertarCategoria($categoria, $descripcion)
	{
		$builder = $this->db->Table('cfg_moduloscategoria');
		$datos = [
			'NOMBRE' => $categoria,
			'DESCRIPCION' => $descripcion,
			'FECHAHORA' => date('Y-m-d H:i:s'),
			'ACTIVO' => 1,
			'USUARIO' => session('id_usuario')
		];
		$builder->insert($datos);
	}
	public function editarCategoria($id,$categoria,$descripcion){
		$builder = $this->db->Table('cfg_moduloscategoria');
		$builder->set('NOMBRE',$categoria);
		$builder->set('DESCRIPCION',$descripcion);
		$builder->where('ID', $id);
		$builder->update();
	}
	public function eliminarCategoria($id){
		$builder = $this->db->Table('cfg_moduloscategoria');
		$builder->where('ID', $id);
		$builder->delete();
	}
}
?>
