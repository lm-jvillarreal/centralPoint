<?php namespace App\Models;
use CodeIgniter\Model;
use Config\Database;

class Usuarios extends Model{
    public function listar(){
        $usuarios=$this->db->table('cfg_usuarios as U');
        $usuarios->select("U.ID, U.NOMBRE_USUARIO");
        $usuarios->select("(SELECT CONCAT(nombre,' ',ap_paterno, ' ',ap_materno) FROM cfg_personas WHERE ID=U.ID) AS COLABORADOR");
        $usuarios->select("(SELECT NOMBRE FROM cfg_perfiles WHERE ID=U.ID_PERFIL) AS PERFIL");
        $usuarios->where("U.ACTIVO",1);
        return $usuarios->get()->getResultArray();
    }
    public function camposUsuario($id_usuario){
        $usuarios=$this->db->table("cfg_usuarios AS U");
        $usuarios->select("U.ID_PERSONA AS ID_COLABORADOR, U.ID_PERFIL,");
        $usuarios->select("( SELECT CONCAT( NOMBRE, ' ', AP_PATERNO, ' ', AP_MATERNO ) FROM cfg_personas WHERE ID = U.ID_PERSONA ) AS COLABORADOR");
        $usuarios->select("( SELECT NOMBRE FROM cfg_perfiles WHERE ID = U.ID_PERFIL ) AS PERFIL");
        $usuarios->where("U.ID",$id_usuario);
        return $usuarios->get()->getResultArray();
    }
    public function obtenerUsuario($data){
        $builder = $this->db->table('cfg_usuarios as U');
        $builder->select(['U.*','P.*']);
        $builder->join('cfg_personas as P','U.ID_PERSONA=P.ID');
        $builder->where('U.NOMBRE_USUARIO',$data);
        //$sql = $builder->getCompiledSelect();
        //echo $sql;
        return $builder->get()->getResultArray();
    }
    public function obtenerPerfil($data){
        $Perfil = $this->db->table('cfg_perfiles');
        $Perfil->select("NOMBRE");
        $Perfil->where("ID",$data);
        return $Perfil->get()->getResultArray();
    }
    public function obtenerSede($data){
        $Sede=$this->db->table('cfg_sedes');
        $Sede->select("NOMBRE");
        $Sede->where("ID",$data);
        return $Sede->get()->getResultArray();
    }

    public function obtenerAcceso($modulo,$usuario){
        $acceso=$this->db->table('cfg_usuariosdetalle');
        $acceso->select("*");
        $acceso->where("ID_USUARIO",$usuario);
        $acceso->where("ID_MODULO",$modulo);
        return $acceso->countAllResults();
    }
    
    public function obtenerRuta($modulo){
        $ruta=$this->db->table("cfg_modulos");
        $ruta->select(["NOMBRE","RUTA"]);
        $ruta->where("ID",$modulo);
        return $ruta->get()->getResultArray();
    }

    public function insertarUsuario($colaborador, $perfil, $usr){
        $usuario=$this->db->table("cfg_usuarios");
        $datos=[
            "ID_PERSONA"=>$colaborador,
            "NOMBRE_USUARIO"=>$usr,
            "PASSWORD"=>password_hash("123456789",PASSWORD_DEFAULT),
            "ID_PERFIL"=>$perfil,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $usuario->insert($datos);
    }
}