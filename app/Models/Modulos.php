<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class Modulos extends Model
{
    public function listarModulos(){
        $modulos = $this->db->table("cfg_modulos as C");
        $modulos->select("C.ID, C.NOMBRE, C.RUTA, C.DESCRIPCION");
        $modulos->select("(SELECT NOMBRE FROM cfg_moduloscategoria WHERE ID=C.CATEGORIA) AS CATEGORIA");
        $modulos->select("C.ICONO, C.TEMA");
        $modulos->where('C.ACTIVO',1);
        return $modulos->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$modulos = $this->db->table("cfg_modulos");
		if($search==""){
			$modulos->select('ID,NOMBRE');
			$modulos->where("ACTIVO",1);
		}else{
			$modulos->select('ID,NOMBRE');
			$modulos->where("ACTIVO",1);
			$modulos->like('NOMBRE',$search);
		}
		return $modulos->get()->getResultArray();
	}
    public function camposModulo($id){
        $modulos = $this->db->table("cfg_modulos as C");
        $modulos->select("C.ID, C.NOMBRE, C.RUTA, C.DESCRIPCION, C.CATEGORIA, C.ICONO, C.TEMA");
        $modulos->select("(SELECT NOMBRE FROM cfg_moduloscategoria WHERE ID=C.CATEGORIA) AS NOMBRE_CATEGORIA");
        $modulos->where("C.ID",$id);
        return $modulos->get()->getResultArray();
    }
    public function insertarModulo($modulo, $ruta, $descripcion, $categoria, $icono, $tema){
        $builder = $this->db->table("cfg_modulos");
        $datos=[
            'NOMBRE'=>$modulo,
            'RUTA'=>$ruta,
            'DESCRIPCION'=>$descripcion,
            'PANELCONTROL'=>'1',
            'CATEGORIA'=>$categoria,
            'ICONO'=>$icono,
            'TEMA'=>$tema,
            'FECHAHORA'=>date("Y-m-d H:i:s"),
            'ACTIVO'=>1,
            'USUARIO'=>session('id_usuario')
        ];
        $builder->insert($datos);
        return $datos;
    }
    public function editarModulo($id_modulo, $modulo, $ruta, $descripcion, $categoria, $icono, $tema)
    {
        $builder=$this->db->table("cfg_modulos");
        $builder->set("NOMBRE",$modulo);
        $builder->set("RUTA",$ruta);
        $builder->set("DESCRIPCION",$descripcion);
        $builder->set("CATEGORIA",$categoria);
        $builder->set("ICONO",$icono);
        $builder->set("TEMA",$tema);
        $builder->where("ID",$id_modulo);
        $builder->update();
    }
    public function eliminarModulo($id_modulo)
    {
        $builder=$this->db->table("cfg_modulos");
        $builder->where("ID",$id_modulo);
        $builder->delete();
    }
}
?>