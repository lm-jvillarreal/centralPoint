<?php
namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class Puestos extends Model{
    public function listarSelect($search){
        $puestos = $this->db->table("cfg_puestos");
        if($search==""){
            $puestos->select("ID,PUESTO");
            $puestos->where("ACTIVO",1);
        }else{
            $puestos->select("ID,PUESTO");
            $puestos->where("ACTIVO",1);
            $puestos->like("PUESTO",$search);
        }
        return $puestos->get()->getResultArray();
    }
}
?>