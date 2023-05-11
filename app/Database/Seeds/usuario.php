<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder{
    public function run(){
        $id_persona=1;
        $nombre_usuario="jvillarreal";
        $password=password_hash("123",PASSWORD_DEFAULT);
        $id_perfil=1;
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            'ID_PERSONA'=>$id_persona,
            'NOMBRE_USUARIO'=>$nombre_usuario,
            'PASSWORD'=>$password,
            'ID_PERFIL'=>$id_perfil,
            'FECHAHORA'=>$fechahora,
            'ACTIVO'=>$activo,
            'USUARIO'=>$usuario
        ];

        $this->db->table('cfg_usuarios')->insert($data);
    }
}
?>