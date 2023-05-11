<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Modulo extends Seeder{
    public function run(){
        $nombre="Modulos";
        $ruta="modulos/index";
        $descripcion="Permite administrar los módulos del sistema";
        $panel_control=1;
        $categoria=1;
        $icono="";
        $tema="";
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            "NOMBRE"=>$nombre,
            "RUTA"=>$ruta,
            "DESCRIPCION"=>$descripcion,
            "PANELCONTROL"=>$panel_control,
            "CATEGORIA"=>$categoria,
            "ICONO"=>$icono,
            "TEMA"=>$tema,
            "FECHAHORA"=>$fechahora,
            "ACTIVO"=>$activo,
            "USUARIO"=>$usuario
        ];

        $this->db->table('cfg_modulos')->insert($data);
    }
}
?>