<?php
namespace App\Models;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Model;

class mCDICalificar extends Model{

   
    public function listarEvaluacion(){
        $detalle = $this->db->table("mCDIEvaluaciones");
        $detalle->select("id, Nombre, Detalles"); // Asegúrate de incluir los detalles necesarios
        $detalle->where("activo", 1);
        return $detalle->get()->getResultArray();
    }
    



}
?>