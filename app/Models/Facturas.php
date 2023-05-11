<?php
namespace App\Models;

use CodeIgniter\Model;

class Facturas extends Model{
    public function listarFacturas(){
        $facturas=$this->db->table("af_factura as F");
        $facturas->select("F.ID, F.ID_PROVEEDOR, F.FOLIO_DOCUMENTO, F.SUBTOTAL, F.IMPUESTOS, F.TOTAL, F.NOMBRE_ARCHIVO");
        $facturas->select("(SELECT NOMBRE FROM af_proveedor WHERE ID=F.ID_PROVEEDOR) AS PROVEEDOR");
        $facturas->where("F.ACTIVO",1);
        return $facturas->get()->getResultArray();
    }
    public function camposFactura($id_factura){
        $facturas=$this->db->table("af_factura as F");
        $facturas->select("F.ID, F.ID_PROVEEDOR, F.FOLIO_DOCUMENTO, F.SUBTOTAL, F.IMPUESTOS, F.TOTAL, F.NOMBRE_ARCHIVO");
        $facturas->select("(SELECT NOMBRE FROM af_proveedor WHERE ID=F.ID_PROVEEDOR) AS PROVEEDOR");
        $facturas->where("F.ID",$id_factura);
        return $facturas->get()->getResultArray();
    }
    public function insertarFactura($proveedor, $folio, $subtotal, $impuestos, $total, $nombre_archivo){
        $facturas=$this->db->table("af_factura");
        $datos=[
            "ID_PROVEEDOR"=>$proveedor,
            "FOLIO_DOCUMENTO"=>$folio,
            "SUBTOTAL"=>$subtotal,
            "IMPUESTOS"=>$impuestos,
            "TOTAL"=>$total,
            "NOMBRE_ARCHIVO"=>$nombre_archivo,
            "FECHAHORA"=>date("Y-m-d H:i:s"),
            "ACTIVO"=>1,
            "USUARIO"=>session("id_usuario")
        ];
        $facturas->insert($datos);
    }
    public function editarFactura($id_factura, $proveedor, $folio, $subtotal, $impuestos, $total, $nombre_archivo){
        $facturas=$this->db->table("af_factura");
        $facturas->set("ID_PROVEEDOR",$proveedor);
        $facturas->set("FOLIO_DOCUMENTO",$folio);
        $facturas->set("SUBTOTAL",$subtotal);
        $facturas->set("IMPUESTOS",$impuestos);
        $facturas->set("TOTAL",$total);
        $facturas->set("FECHAHORA",date("Y-m-d H:i:s"));
        $facturas->where("ID",$id_factura);
        $facturas->update();
    }
    public function eliminarFactura($id){
        $facturas=$this->db->table("af_factura");
        $facturas->set("ACTIVO",0);
        $facturas->where("ID",$id);
        $facturas->update();
    }
}
?>