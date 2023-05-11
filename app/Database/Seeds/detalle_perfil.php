<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Detalle_perfil extends Seeder{
    public function run(){
        $id_perfil=1;
        $id_modulo=1;
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            'ID_PERFIL'=>$id_perfil,
            'ID_MODULO'=>$id_modulo,
            'FECHAHORA'=>$fechahora,
            'ACTIVO'=>$activo,
            'USUARIO'=>$usuario            
        ];

        $this->db->table('cfg_detalleperfil')->insert($data);
    }
}
?>