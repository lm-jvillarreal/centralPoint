<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Perfil extends Seeder{
    public function run(){
        $nombre="Administrador";
        $descripcion="Tiene acceso completo al sistema";
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            'NOMBRE'=>$nombre,
            'DESCRIPCION'=>$descripcion,
            'FECHAHORA'=>$fechahora,
            'ACTIVO'=>$activo,
            'USUARIO'=>$usuario
        ];

        $this->db->table('cfg_perfiles')->insert($data);
    }
}
?>