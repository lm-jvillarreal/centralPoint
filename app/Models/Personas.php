<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Personas extends Model{
    public function listarPersonas(){
        $personas = $this->db->table("cfg_personas AS P");
        $personas->select("P.ID");
        $personas->select("CONCAT(P.NOMBRE,' ',P.AP_PATERNO,' ',P.AP_MATERNO) AS NOMBRE");
        $personas->select("(SELECT NOMBRE FROM cfg_sedes WHERE ID=P.ID_SEDE) AS SEDE");
        $personas->select("(SELECT TIPO FROM cfg_personastipo WHERE ID=P.TIPO_PERSONA) AS TIPO_PERSONA");
        $personas->where("P.ACTIVO",1);
        return $personas->get()->getResultArray();

    }
    public function listarSelect($search){
        $personas = $this->db->table("cfg_personas");
		if($search==""){
			$personas->select("ID,CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) AS NOMBRE");
			$personas->where("ACTIVO",1);
		}else{
			$personas->select("ID,CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) AS NOMBRE");
			$personas->where("ACTIVO",1);
			$personas->like("CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO)",$search);
		}
		return $personas->get()->getResultArray();

    }
    public function camposPersona($id){
        $personas = $this->db->table("cfg_personas AS P");
        $personas->select("P.ID,P.NOMBRE,P.AP_PATERNO,P.AP_MATERNO,P.ID_SEDE, P.TIPO_PERSONA AS ID_TIPO");
        $personas->select("(SELECT NOMBRE FROM cfg_sedes WHERE ID=P.ID_SEDE) AS NOMBRE_SEDE");
        $personas->select("P.TITULO, P.SEXO, P.RFC, P.CURP, P.ECIVIL, P.EMAIL, P.TELEFONO");
        $personas->select("(SELECT TIPO FROM cfg_personasTipo WHERE ID=P.TIPO_PERSONA) AS TIPO");
        $personas->where("P.ID",$id);
        return $personas->get()->getResultArray();
    }
    public function insertarPersona($nombre, $ap_paterno,$ap_materno,$sede, $tipo_persona)
    {
        $persona=$this->db->table("cfg_personas");
        //Insertar
        $datos=[
            "TIPO_PERSONA"=>$tipo_persona,
            "NOMBRE"=>$nombre,
            "AP_PATERNO"=>$ap_paterno,
            "AP_MATERNO"=>$ap_materno,
            'SEXO' => '',
            'FECHANACIMIENTO' => '1976-01-01',
            'RFC' => '',
            'CURP' => '',
            'ECIVIL' => '',
            'EMAIL' => '',
            'TELEFONO' => '',
            'COLONIA' => '',
            'CALLE' => '',
            'NUMERO' => '',
            'MUNICIPIO' => '',
            'ESTADO' => '',
            'CODIGOPOSTAL' => '',
            "ID_SEDE"=>$sede,
            'TITULO' => '',
            'ACTUALIZADO' => '0',
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $persona->insert($datos);
        //return $persona->set($datos)->getCompiledInsert();
    }
    public function editarPersona($id_persona, $nombre, $ap_paterno, $ap_materno, $sede)
    {
        $personas=$this->db->table("cfg_personas");
        $personas->set("NOMBRE",$nombre);
        $personas->set("AP_PATERNO",$ap_paterno);
        $personas->set("AP_MATERNO",$ap_materno);
        $personas->set("ID_SEDE",$sede);
        $personas->set("FECHAHORA",date("Y-m-d H:i:s"));
        $personas->where("ID",$id_persona);
        $personas->update();
    }
    public function eliminarPersona($id_persona){
        $personas=$this->db->table("cfg_personas");
        $personas->set("ACTIVO",0);
        $personas->where("ID",$id_persona);
        $personas->update();
    }
    public function passReseter($id_usuario,$pass){
        $usuarios=$this->db->table("cfg_usuarios");
        $password=password_hash($pass,PASSWORD_DEFAULT);
        $usuarios->set("PASSWORD",$password);
        $usuarios->where("ID",$id_usuario);
        $usuarios->update();
    }
    public function misDatos($id_usuario,$titulo,$nombre,$ap_paterno,$ap_materno,$sexo,$curp,$ecivil,$departamento,$num_empleado,$rfc,$celular,$email){
        $personas=$this->db->table('cfg_personas');
        $personas->set("TITULO",$titulo);
        $personas->set("NOMBRE",$nombre);
        $personas->set("AP_PATERNO",$ap_paterno);
        $personas->set("AP_MATERNO",$ap_materno);
        $personas->set("SEXO",$sexo);
        $personas->set("CURP",$curp);
        $personas->set("ECIVIL",$ecivil);
        //$personas->set("DEPARTAMENTO",$departamento); ESTA EN COLABORADORES
        //$personas->set("NUM_EMPLEADO",$num_empleado); ESTA EN COLABORADORES
        $personas->set("RFC",$rfc);
        $personas->set("TELEFONO",$celular);
        $personas->set("EMAIL",$email);
        $personas->where("ID",$id_usuario);
        $personas->update();
    }
}
?>