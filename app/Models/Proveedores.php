<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Session\Session;

class Proveedores extends Model{
    public function listar(){
        $proveedores=$this->db->table("af_proveedor");
        $proveedores->select("ID, NOMBRE, RAZON_SOCIAL, RFC, TELEFONO, EMAIL");
        $proveedores->where("ACTIVO",1);
        return $proveedores->get()->getResultArray();
    }
    public function listarSelect($search)
	{
		$proveedores = $this->db->table("af_proveedor");
		if($search==""){
			$proveedores->select('ID,NOMBRE');
			$proveedores->where("ACTIVO",1);
		}else{
			$proveedores->select('ID,NOMBRE');
			$proveedores->where("ACTIVO",1);
			$proveedores->like('TIPO',$search);
		}
		return $proveedores->get()->getResultArray();
	}
    public function camposProveedor($id_proveedor){
        $proveedores=$this->db->table("af_proveedor AS P");
        $proveedores->select("P.ID,P.NOMBRE,P.RAZON_SOCIAL,P.RFC,P.DIRECCION,P.TELEFONO,P.EMAIL,P.DESCRIPCION_PROVEEDOR,TP.ID AS ID_CATEGORIA,TP.NOMBRE AS CATEGORIA");
        $proveedores->join("af_tipoproveedor as TP","P.ID_CATEGORIA=TP.ID");
        $proveedores->where("P.ID",$id_proveedor);
        return $proveedores->get()->getResultArray();
        //return $proveedores->getCompiledSelect();
    }
    public function insertarProveedor($nombre, $razon_social, $rfc, $direccion, $telefono, $email, $categoria, $descripcion){
		$proveedores=$this->db->table("af_proveedor");
		$datos=[
			"NOMBRE"=>$nombre,
			"RAZON_SOCIAL"=>$razon_social,
            "RFC"=>$rfc,
            "DIRECCION"=>$direccion,
            "TELEFONO"=>$telefono,
            "EMAIL"=>$email,
            "ID_CATEGORIA"=>$categoria,
            "DESCRIPCION_PROVEEDOR"=>$descripcion,
			"FECHAHORA"=>date("Y-m-d H:i:s"),
			"ACTIVO"=>1,
			"USUARIO"=>session('id_usuario')
		];
		//return  $proveedores->set($datos)->getCompiledInsert();
        $proveedores->insert($datos);
	}
    public function editarProveedor($id, $nombre, $razon_social, $rfc, $direccion, $telefono, $email, $categoria, $descripcion){
        $proveedores=$this->db->table("af_proveedor");
        $proveedores->set("NOMBRE",$nombre);
        $proveedores->set("RAZON_SOCIAL",$razon_social);
        $proveedores->set("RFC",$rfc);
        $proveedores->set("DIRECCION",$direccion);
        $proveedores->set("TELEFONO",$telefono);
        $proveedores->select("EMAIL",$email);
        $proveedores->select("ID_CATEGORIA",$categoria);
        $proveedores->select("DESCRIPCION_PROVEEDOR",$descripcion);
        $proveedores->select("FECHAHORA",date("Y-m-d H:i:s"));
        $proveedores->select("ACTIVO",1);
        $proveedores->select("USUARIO",Session("id_usuario"));
        $proveedores->update();
    }
    public function eliminarProveedores($id){
        $proveedores=$this->db->table("af_proveedor");
        $proveedores->set("ACTIVO",0);
        $proveedores->where("ID",$id);
        $proveedores->update();
    }
}
?>