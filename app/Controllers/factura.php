<?php
namespace App\Controllers;

use App\Models\Facturas;
use CodeIgniter\Config\ForeignCharacters;

class factura extends BaseController{
    public function index(){
    }
    public function listar(){
        $facturas=new Facturas();
        $facturas=$facturas->listarFacturas();
        $array=[];
        foreach($facturas as $resultado){
            array_push($array,[
                "id"=>$resultado["ID"],
                "proveedor"=>$resultado["PROVEEDOR"],
                "folio_documento"=>$resultado["FOLIO_DOCUMENTO"],
                "subtotal"=>$resultado["SUBTOTAL"],
                "impuestos"=>$resultado["IMPUESTOS"],
                "total"=>$resultado["TOTAL"]
            ]);
        }
        echo json_encode($array);
    }
    public function campos(){
        $facturas=new Facturas();
        $id_factura=$this->request->getPost('id');
        $facturas=$facturas->camposFactura($id_factura);
        echo json_encode(
            [
                "id"=>$facturas[0]['ID'],
                "folio"=>$facturas[0]['FOLIO_DOCUMENTO'],
                "subtotal"=>$facturas[0]['SUBTOTAL'],
                "impuestos"=>$facturas[0]['IMPUESTOS'],
                "total"=>$facturas[0]['TOTAL'],
                "id_proveedor"=>$facturas[0]['ID_PROVEEDOR'],
                "proveedor"=>$facturas[0]['PROVEEDOR']
            ]
        );
    }
    public function insertar(){
        if(!$this->validate([
            'txt_proveedor'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes seleccionar un proveedor'
                ]
            ],
            'txt_folio'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes ingresar un folio de factura'
                ]
            ],
            'txt_subtotal'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes ingresar el subtotal'
                ]
            ],
            'txt_impuestos'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes ingresar el valor de impuestos'
                ]
            ],
            'txt_total'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debes ingresar el total'
                ]
            ],
            'txt_documento'=>[
                'rules'=>'uploaded[txt_documento]|max_size[txt_documento,2048]|ext_in[txt_documento,pdf]',
                'errors'=>[
                    'max_size'=>'El archivo adjunto supera el tamaño permitido',
                    'ext_in'=>'La extensión del archivo no está permitido'
                ]
            ]
        ])){
            $proveedor=$this->validator->getError('txt_proveedor');
            $folio=$this->validator->getError('txt_folio');
            $subtotal=$this->validator->getError('txt_subtotal');
            $impuestos=$this->validator->getError('txt_impuestos');
            $total=$this->validator->getError('txt_total');
            $factura=$this->validator->getError('txt_documento');
            $errores=[
                "proveedor"=>$proveedor,
                "folio"=>$folio,
                "subtotal"=>$subtotal,
                "impuestos"=>$impuestos,
                "total"=>$total,
                "documento"=>$factura
            ];
            echo json_encode($errores);

            $response = service('response');
            $response->setStatusCode(400);
            $response->setHeader('Content-type', 'text/html');
            $response->noCache();
            $response->send();
        }else{
            $id_factura=$this->request->getPost('id');
            $proveedor=$this->request->getPost('txt_proveedor');
            $folio=$this->request->getPost('txt_folio');
            $subtotal=$this->request->getPost('txt_subtotal');
            $impuestos=$this->request->getPost('txt_impuestos');
            $total=$this->request->getPost('txt_total');
            $newName="";
            if($factura = $this->request->getFile('txt_documento')){
                if($factura->isValid()){
                    $newName = $factura->getRandomName();
                    $factura->move(WRITEPATH . 'uploads', $newName);
                }
            }
            $facturas=new Facturas();
            if($id_factura==""){
                $facturas=$facturas->insertarFactura($proveedor, $folio,$subtotal, $impuestos, $total,$newName);
                echo json_encode(["msg"=>"insertado"]);
            }else if($id_factura!=""){
                $facturas=$facturas->editarFactura($id_factura, $proveedor, $folio, $subtotal, $impuestos, $total,$newName);
                echo json_encode(["msg"=>"editado"]);
            }
        }
    }
    public function eliminar(){
        $id_factura=$this->request->getPost('id');
        $facturas=new Facturas();
        $facturas=$facturas->eliminarFactura($id_factura);
        echo json_encode(["msg"=>"eliminado"]);
    }
}
?>