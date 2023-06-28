<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class Grupos extends Model{
    public function listarGrupos(){
        $grupos=$this->db->table("mCDIGrupos AS G");
        $grupos->select("G.id, G.id_Plan, G.id_periodo, G.nivel, id_docente");
        $grupos->select("(SELECT CONCAT(nombre) FROM mCDIPlanEstudios WHERE id=G.id_Plan)");
        $grupos->select("(SELECT CONCAT(periodo) FROM mCDIPeriodos WHERE id=G.id_periodo)");

        return $grupos->get()->getResultArray();
    }
    public function listarSelect($search)
    {
        $grupos = $this->db->table("mCDIGrupos");
        if($search==""){
            $grupos->select('id,id_Plan,id_periodo,nivel,docente');
            $grupos->where("activo",1);
        }
        else
        {
            $grupos->select('id,id_Plan,id_periodo,nivel,docente');
            $grupos->where("activo",1);
            $grupos->like('id_Plan',$search);
        }
    }
    public function camposGrupos($id){
        $grupos=$this->db->table("mCDIGrupos AS G");
        $grupos->select("G.id, G.id_Plan, G.id_periodo, G.nivel, id_docente");
        $grupos->select("(SELECT CONCAT(nombre) FROM mCDIPlanEstudios WHERE id=G.id_Plan)");
        // $grupos->select("(SELECT CONCAT(periodo) FROM mCDIPeriodos WHERE id=G.id_periodo)");
      
        return $grupos->get()->getResultArray();
    }
    public function insertarGrupos($nombre, $periodo, $nivel, $docente ){
        $grupos=$this->db->table("mCDIGrupos");
        $datos=[
            "id_Plan"=>$nombre,
            "id_periodo"=>$periodo,
            "nivel"=>$nivel,
            "id_docente"=>$docente,
            "fechahora"=>date("Y-m-d H:i:s"),
            "activo"=>1,
            "usuario"=>session('id_usuario')
        ];
        $grupos->insert($datos);
    }
    public function editarGrupos($id_grupo,$nombre,$periodo,$nivel,$docente){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->set("id_Plan",$nombre);
        $grupos->set("id_periodo",$periodo);
        $grupos->set("nivel",$nivel);
        $grupos->set("id_docente",$docente);
        $grupos->set("fechahora",date_time("Y-m-d H:i:s"));
        $grupos->set("activo",1);
        $grupos->set("usuario",session('id_usuario'));
        $grupos->where("id",$id_grupo);
        $grupos->update();
    }
    public function eliminarGrupos($id){
        $grupos=$this->db->table("mCDIGrupos");
        $grupos->set("activo",0);
        $grupos->where("id",$id);
    }

}

?>