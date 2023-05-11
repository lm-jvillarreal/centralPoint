<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class PerfilesDetalles extends Model
{
    public function listarDetalles()
	{
		$detalleCat = $this->db->table("cfg_detalleperfil AS D");
        $detalleCat->select("D.ID");
		$detalleCat->select("(SELECT NOMBRE FROM cfg_perfiles WHERE ID=D.ID_PERFIL) AS PERFIL");
        $detalleCat->select("(SELECT NOMBRE FROM cfg_modulos WHERE ID=D.ID_MODULO) AS MODULO");
		$detalleCat->where("ACTIVO", 1);

		return $detalleCat->get()->getResultArray();
	}
    public function insertarDetalle($perfil,$modulos)
    {
        $i=0;
        $detalleCat=$this->db->table("cfg_detalleperfil");
        foreach($modulos as $row)
        {
            //Eliminar si existe
            $detalleCat->where("ID_PERFIL",$perfil);
            $detalleCat->where("ID_MODULO",$modulos[$i]);
            $detalleCat->delete();
            //Insertar
            $datos=[
                "ID_PERFIL"=>$perfil,
                "ID_MODULO"=>$modulos[$i],
                "FECHAHORA"=>date("Y-m-d H:i:s"),
                "ACTIVO"=>1,
                "USUARIO"=>session('id_usuario')
            ];
            $detalleCat->insert($datos);
            $i++;
        }
    }
    public function eliminarDetalle($id_detalle)
    {
        $detalleCat=$this->db->table("cfg_detalleperfil");
        $detalleCat->where("ID",$id_detalle);
        $detalleCat->delete();
    }
}
?>