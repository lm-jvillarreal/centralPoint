<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Persona extends Seeder{
    public function run(){
        $nombre="Josué Itonio";
        $ap_paterno="Villarreal";
        $ap_materno="Alvarado";
        $sexo="H";
        $fecha_nacimiento=date("1991-08-29");;
        $rfc="VIAJ910829C71";
        $curp="VIAJ910829HTSLLS09";
        $ecivil="Soltero";
        $email="jvillarreal@lamisionsuper.com";
        $telefono="8117598102";
        $colonia="Gloria Mendiola";
        $calle="Garza Noriega";
        $numero="100";
        $municipio="Linares";
        $estado="Nuevo León";
        $cp="67700";
        $id_sede="1";
        $num_emp="130";
        $depto="Sistemas";
        $extension="6100";
        $titulo="Ing.";
        $actualizado="1";
        $fechahora=date("Y-m-d H:i:s");
        $activo=1;
        $usuario=1;

        $data=[
            'NOMBRE'=>$nombre,
            'AP_PATERNO'=>$ap_paterno,
            'AP_MATERNO'=>$ap_materno,
            'SEXO'=>$sexo,
            'FECHANACIMIENTO'=>$fecha_nacimiento,
            'RFC'=>$rfc,
            'CURP'=>$curp,
            'ECIVIL'=>$ecivil,
            'EMAIL'=>$email,
            'TELEFONO'=>$telefono,
            'COLONIA'=>$colonia,
            'CALLE'=>$calle,
            'NUMERO'=>$numero,
            'MUNICIPIO'=>$municipio,
            'ESTADO'=>$estado,
            'CODIGOPOSTAL'=>$cp,
            'ID_SEDE'=>$id_sede,
            'NUM_EMPLEADO'=>$num_emp,
            'DEPARTAMENTO'=>$depto,
            'EXTENSION'=>$extension,
            'TITULO'=>$titulo,
            'ACTUALIZADO'=>$actualizado,
            'FECHAHORA'=>$fechahora,
            'ACTIVO'=>$activo,
            'USUARIO'=>$usuario
        ];

        $this->db->table('cfg_personas')->insert($data);
    }
}
?>