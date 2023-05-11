<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Sedes extends Seeder{
    public function run(){
        $nombre="DIAZ ORDAZ";
        $direccion="Garza Noriega 100, Col. Gloria Mendiola, Linares, Nuevo León";
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            "NOMBRE"=>$nombre,
            "DIRECCION"=>$direccion,
            "FECHAHORA"=>$fechahora,
            "ACTIVO"=>$activo,
            "USUARIO"=>$usuario
        ];

        $this->db->table('cfg_sedes')->insert($data);
    }
}
?>