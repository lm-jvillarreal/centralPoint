<?php
namespace App\Models;

use CodeIgniter\Model;

class Mobiliarios extends Model
{
    public function listarMobiliario(){
        $mobiliario=$this->db->table("af_mobiliario");
        $mobiliario->select("ID, MARCA, MODELO, NUMERO_SERIE, DESCRIPCION");
        $mobiliario->select("(SELECT NOMBRE FROM af_mobiliariocategorias WHERE ID=ID_MOBCATEGORIA) AS MOBCATEGORIA");
        $mobiliario->where("ACTIVO",1);
        return $mobiliario->get()->getResultArray();
    }
    public function listarSelect($search){
        $mobiliario=$this->db->table("af_mobiliario");
        if($search==""){
            $mobiliario->select("ID, DESCRIPCION");
            $mobiliario->where("ACTIVO",1);
        }else{
            $mobiliario->select("ID, DESCRIPCION");
            $mobiliario->where("ACTIVO",1);
            $mobiliario->like("DESCRIPCION",$search);
        }
        return $mobiliario->get()->getResultArray();
    }
    public function camposMobiliario($id){
        $mobiliario=$this->db->table("af_mobiliario");
        $mobiliario->select("ID, INVENTARIO, MARCA, MODELO, NUMERO_SERIE, DESCRIPCION, OTROS_DATOS, ID_MOBCATEGORIA");
        $mobiliario->select("(SELECT NOMBRE FROM af_mobiliariocategorias WHERE ID=af_mobiliario.ID_MOBCATEGORIA) AS MOBCATEGORIA");
        $mobiliario->where("ID",$id);
        return $mobiliario->get()->getResultArray();
    }
    public function insertarMobiliario($inventario, $marca, $modelo, $numero_serie, $descripcion, $otros_datos, $id_mobcategoria, $id_area, $id_factura){
        $mobiliario=$this->db->table("af_mobiliario");
        $datos=[
            "INVENTARIO"=>$inventario,
            "MARCA"=>$marca,
            "MODELO"=>$modelo,
            "NUMERO_SERIE"=>$numero_serie,
            "DESCRIPCION"=>$descripcion,
            "OTROS_DATOS"=>$otros_datos,
            "ID_MOBCATEGORIA"=>$id_mobcategoria,
            "ID_AREA"=>$id_area,
            "ID_FACTURA"=>$id_factura,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $mobiliario->insert($datos);
        //return $mobiliario->set($datos)->getCompiledInsert();
    }
    public function editarMobiliario($id, $inventario, $marca, $modelo, $numero_serie, $descripcion, $otros_datos, $id_mobcategoria, $id_area, $id_factura){
        $mobiliario=$this->db->table("af_mobiliario");
        $mobiliario->set("INVENTARIO",$inventario);
        $mobiliario->set("MARCA",$marca);
        $mobiliario->set("MODELO",$modelo);
        $mobiliario->set("NUMERO_SERIE",$numero_serie);
        $mobiliario->set("DESCRIPCION",$descripcion);
        $mobiliario->set("OTROS_DATOS",$otros_datos);
        $mobiliario->set("ID_MOBCATEGORIA",$id_mobcategoria);
        $mobiliario->set("ID_AREA",$id_area);
        $mobiliario->set("ID_FACTURA",$id_factura);
        $mobiliario->set("FECHAHORA",date("Y-m-d H:i:s"));
        $mobiliario->set("ACTIVO",1);
        $mobiliario->set("USUARIO",session("id_usuario"));
        $mobiliario->where("ID",$id);
        $mobiliario->update();
        //return $mobiliario->getCompiledUpdate();
    }

    public function eliminarMobiliario($id){
        $mobiliario=$this->db->table("af_mobiliario");
        $mobiliario->set("ACTIVO",0);
        $mobiliario->where("ID",$id);
        $mobiliario->update();
    }
}
?>