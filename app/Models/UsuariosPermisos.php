<?php
namespace App\Models;
use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class UsuariosPermisos extends Model{
        public function listarPermisos($id_usuario){
            $permisos = $this->db->table("cfg_usuariosdetalle as D");
		    $permisos->select("D.ID, D.SOLO_SUCURSAL, D.REGISTROS_PROPIOS, D.SOLO_LECTURA");
            $permisos->select("(SELECT NOMBRE FROM cfg_modulos WHERE ID=D.ID_MODULO) AS MODULO");
		    $permisos->where("ID_USUARIO", $id_usuario);
		    return $permisos->get()->getResultArray();
        }
        public function insertarPermisos($usuario,$modulo,$categoria,$solo_sede,$solo_lectura,$reg_prop){
            $permisos=$this->db->table("cfg_usuariosdetalle");
            $datos=[
                "ID_USUARIO"=>$usuario,
                "ID_MODULO"=>$modulo,
                "ID_CATEGORIA"=>$categoria,
                "SOLO_SUCURSAL"=>$solo_sede,
                "REGISTROS_PROPIOS"=>$reg_prop,
                "SOLO_LECTURA"=>$solo_lectura,
                "FECHAHORA"=>date("Y-m-d H:i:s"),
                "ACTIVO"=>1,
                "USUARIO"=>session('id_usuario')
            ];
            $permisos->insert($datos);
        }
        public function camposPermiso($id_permiso){
            $permisos=$this->db->table("cfg_usuariosdetalle as D");
            $permisos->select("D.SOLO_SUCURSAL, D.REGISTROS_PROPIOS, D.SOLO_LECTURA");
            $permisos->select("(SELECT CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) FROM cfg_personas WHERE ID=D.ID_USUARIO) as usuario");
            $permisos->select("(SELECT NOMBRE FROM cfg_modulos WHERE ID=D.ID_MODULO) as modulo");
            $permisos->where("ID",$id_permiso);
            return $permisos->get()->getResultArray();
        }
}
?>