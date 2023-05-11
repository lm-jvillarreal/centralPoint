<?php 
namespace App\Models;
use CodeIgniter\Model;

class PanelControl extends Model{
    public function Categorias($usuario){
        $categoria = $this->db->table("cfg_moduloscategoria as C");
        $categoria->select("D.ID_CATEGORIA");
        $categoria->distinct();
        $categoria->select("C.NOMBRE");
        $categoria->join("cfg_usuariosdetalle as D","C.ID=D.ID_CATEGORIA");
        $categoria->where("D.ID_USUARIO",$usuario);
        $result=array();
        $i=0;
        foreach($categoria->get()->getResultArray() as $rowCategorias){
            array_push($result,array(
                "id_categoria"=>$rowCategorias['ID_CATEGORIA'],
                "categoria"=>$rowCategorias['NOMBRE'],
                "modulos"=>[]
            ));

            $modulos=$this->db->table("cfg_modulos as M");
            $modulos->select("M.ID, M.NOMBRE, M.RUTA, M.ICONO, M.TEMA");
            $modulos->join("cfg_usuariosdetalle as D","M.ID=D.ID_MODULO");
            $modulos->where("D.ID_USUARIO",session('id_usuario'));
            $modulos->where("M.CATEGORIA",$rowCategorias['ID_CATEGORIA']);
            $modulos->where("M.PANELCONTROL",1);

            foreach($modulos->get()->getResultArray() as $rowModulos){
                array_push($result[$i]['modulos'],array(
                    "id_modulo"=>$rowModulos['ID'],
                    "modulo"=>$rowModulos["NOMBRE"],
                    "ruta"=>$rowModulos["RUTA"],
                    "icono"=>$rowModulos["ICONO"],
                    "tema"=>$rowModulos["TEMA"]
                ));
            }
            $i++;
        }
        return $result;
    }
}
?>