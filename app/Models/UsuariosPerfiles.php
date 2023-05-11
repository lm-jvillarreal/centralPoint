<?php
namespace App\Models;
use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class UsuariosPerfiles extends Model
{
    public function listarPerfiles()
    {
        $perfiles = $this->db->table("cfg_perfiles");
		$perfiles->select("*");
		$perfiles->where("ACTIVO", 1);
		return $perfiles->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$perfiles = $this->db->table("cfg_perfiles");
		if($search==""){
			$perfiles->select('ID,NOMBRE');
			$perfiles->where("ACTIVO",1);
		}else{
			$perfiles->select('ID,NOMBRE');
			$perfiles->where("ACTIVO",1);
			$perfiles->like('NOMBRE',$search);
		}
		return $perfiles->get()->getResultArray();
	}
    public function insertarPerfil($perfil, $descripcion)
    {
        $builder=$this->db->table("cfg_perfiles");
        $datos=[
            "NOMBRE"=>$perfil,
            "DESCRIPCION"=>$descripcion,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $builder->insert($datos);

    }
    public function editarPerfil($id, $perfil, $descripcion)
    {
        $builder=$this->db->table("cfg_perfiles");
        $builder->set("NOMBRE",$perfil);
        $builder->set("DESCRIPCION",$descripcion);
        $builder->where("ID",$id);
        $builder->update();
    }
    public function eliminarPerfil($id_perfil)
    {
        $builder=$this->db->table("cfg_perfiles");
        $builder->where("ID",$id_perfil);
        $builder->delete();
    }
}