<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Departamentos extends Model{
    public function listarDepartamentos(){
        $departamentos=$this->db->table("cfg_departamentos AS D");
        $departamentos->select("D.ID, D.NOMBRE, D.ABREVIATURA, D.EXTENSION, D.ID_PERSONA");
        $departamentos->select("(SELECT CONCAT(NOMBRE,' ',AP_PATERNO,' ',LEFT(AP_MATERNO,1),'.') FROM cfg_personas WHERE ID=D.ID_PERSONA) AS RESPONSABLE");
        return $departamentos->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$departamentos = $this->db->table("cfg_departamentos");
		if($search==""){
			$departamentos->select('ID,NOMBRE');
			$departamentos->where("ACTIVO",1);
		}else{
			$departamentos->select('ID,NOMBRE');
			$departamentos->where("ACTIVO",1);
			$departamentos->like('NOMBRE',$search);
		}
		return $departamentos->get()->getResultArray();
	}
    public function camposDepartamento($id){
        $departamentos=$this->db->table("cfg_departamentos AS D");
        $departamentos->select("D.ID, D.NOMBRE, D.ABREVIATURA, D.EXTENSION, D.ID_PERSONA");
        $departamentos->select("(SELECT CONCAT(NOMBRE,' ',AP_PATERNO,' ',AP_MATERNO) FROM cfg_personas WHERE ID=D.ID_PERSONA) AS RESPONSABLE");
        $departamentos->where("D.ID",$id);
        return $departamentos->get()->getResultArray();
    }
    public function insertarDepartamento($departamento, $extension, $abreviatura, $responsable){
        $departamentos=$this->db->table("cfg_departamentos");
        $datos=[
            "NOMBRE"=>$departamento,
            "EXTENSION"=>$extension,
            "ID_PERSONA"=>$responsable,
            "ABREVIATURA"=>$abreviatura,
            "HORA"=>date("H:i:s"),
            "FECHA"=>date("Y-m-d"),
            "ACTIVO"=>1,
            "USUARIO"=>session('id_usuario')
        ];
        $departamentos->insert($datos);
    }
    public function editarDepartamento($id_departamento,$departamento, $extension, $abreviatura, $responsable){
        $departamentos=$this->db->table("cfg_departamentos");
        $departamentos->set("NOMBRE",$departamento);
        $departamentos->set("EXTENSION",$extension);
        $departamentos->set("ID_PERSONA",$responsable);
        $departamentos->set("ABREVIATURA",$abreviatura);
        $departamentos->set("HORA",date("H:i:s"));
        $departamentos->set("FECHA",date("Y-m-d"));
        $departamentos->set("ACTIVO",1);
        $departamentos->set("USUARIO",session('id_usuario'));
        $departamentos->where("ID",$id_departamento);
        $departamentos->update();
    }
    public function eliminarDepartamento($id){
        $departamentos=$this->db->table("cfg_departamentos");
        $departamentos->set("ACTIVO",0);
        $departamentos->where("ID",$id);
    }
}
?>