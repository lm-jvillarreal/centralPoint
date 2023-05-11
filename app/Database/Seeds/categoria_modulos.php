<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categoria_modulos extends Seeder{
    public function run(){
        $nombre="Administración y seguridad";
        $descripcion="Contiene los módulos que intervienen en la administración del sistema y la seguridad del mismo";
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            "NOMBRE"=>$nombre,
            "DESCRIPCION"=>$descripcion,
            "FECHAHORA"=>$fechahora,
            "ACTIVO"=>$activo,
            "USUARIO"=>$usuario
        ];
        $this->db->table('cfg_moduloscategoria')->insert($data);
    }
}
?>