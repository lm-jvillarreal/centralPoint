<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuariodetalle extends Seeder{
    public function run(){
        $id_usuario=1;
        $id_modulo=2;
        $id_categoria=1;
        $solo_sucursal=1;
        $registros_propios=1;
        $solo_lectura=1;
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;   

        $data=[
            "ID_USUARIO"=>$id_usuario,
            "ID_MODULO"=>$id_modulo,
            "ID_CATEGORIA"=>$id_categoria,
            "SOLO_SUCURSAL"=>$solo_sucursal,
            "REGISTROS_PROPIOS"=>$registros_propios,
            "SOLO_LECTURA"=>$solo_lectura,
            "FECHAHORA"=>$fechahora,
            "ACTIVO"=>$activo,
            "USUARIO"=>$usuario
        ];

        $this->db->table('cfg_usuariosdetalle')->insert($data);
    }
}
?>