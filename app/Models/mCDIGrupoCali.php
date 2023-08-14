<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDIGrupoCali extends Model{
    public function listarGrupos(){
        $id_usuario = session("id_usuario"); // Obtener el ID de usuario de la sesión
        
        $grupos = $this->db->table("mCDIGrupos as G");
        $grupos->select("G.id, G.nivel");
      
        $grupos->where("G.ACTIVO", 1);
        $grupos->where("usuario", $id_usuario); // Filtrar por el ID del usuario de la sesión
        
        return $grupos->get()->getResultArray();
    }
    
    
}




?>