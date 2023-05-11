<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\UsuariosPerfiles;
use App\Models\Personas;
use App\Models\UsuariosPermisos;
use App\Models\Modulos;
use CodeIgniter\HTTP\Response;

class usuariosPermiso extends BaseController{
    public function index(){

    }
    public function listar(){
        $permisos = new UsuariosPermisos();
        $id_usuario=$this->request->getPost('usuario');
        $permisos=$permisos->listarPermisos($id_usuario);
        
        $array=array();
        foreach($permisos as $resultado){
            if($resultado["SOLO_SUCURSAL"]==1){
                $solo_sede="<center><i class=\"fa fa-check\" aria-hidden=\"true\"></i><center>";
            }else{
                $solo_sede="";
            }
            if($resultado["SOLO_LECTURA"]==1){
                $solo_lectura="<center><i class=\"fa fa-check\" aria-hidden=\"true\"></i></center>";
            }else{
                $solo_lectura="";
            }
            if($resultado["REGISTROS_PROPIOS"]==1){
                $registros_propios="<center><i class=\"fa fa-check\" aria-hidden=\"true\"></i></center>";
            }else{
                $registros_propios="";
            }
            array_push($array,array(
                "id"=>$resultado["ID"],
                "modulo"=>$resultado["MODULO"],
                "solo_sede"=>$solo_sede,
                "solo_lectura"=>$solo_lectura,
                "registros_propios"=>$registros_propios
            ));
        }
        echo json_encode($array);
    }
	public function campos(){
		$permisos = new UsuariosPermisos();
		$id_permiso = $this->request->getPost('idC');
		$permisos=$permisos->camposPermiso($id_permiso);
		if($permisos[0]['SOLO_SUCURSAL']=='1'){
			$solo_sucursal="checked";
		}else{
			$solo_sucursal="";
		}
		if($permisos[0]['SOLO_SEDE']=='1'){
			$solo_sede="checked";
		}else{
			$solo_sede="";
		}
		if($permisos[0]['REGISTROS_PROPIOS']=='1'){
			$registros_propios="checked";
		}else{
			$registros_propios="";
		}
		echo json_encode(
			array(
				'id'=>$id_permiso,
				'solo_sucursal'=>$solo_sucursal,
				'solo_sede'=>$solo_sede,
				'registros_propios'=>$registros_propios
			)
		);
	}
    public function insertar()
	{
		if (!$this->validate([
			'txt_usuario' => [
				'rules' => 'required',
				'errors' => [
					"required" => "Debes seleccionar un usuario"
				]
			],
			'txt_modulo' => [
				'rules' => 'required',
				'errors' => [
					'required' => "Debes seleccionar un módulo"
				]
			]
		])) {
			$usuario = $this->validator->getError('txt_usuario');
			$modulo = $this->validator->getError('txt_modulo');
			$errores = [
				'usuario' => $usuario,
				'modulo' => $modulo
			];
			echo json_encode($errores);
			$response = service('response');

			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$id_permiso=$this->request->getPost('id');
			$usuario = $this->request->getPost('txt_usuario');
			$modulo = $this->request->getPost('txt_modulo');
            $solo_sede = $this->request->getPost('chk_soloSede');
            $solo_lectura=$this->request->getPost('chk_soloLectura');
            $reg_prop=$this->request->getPost("chk_regProp");
			$permisos = new UsuariosPermisos();
            $modulos=new Modulos();
            $modulos=$modulos->camposModulo($modulo);
            $id_categoria=$modulos[0]['CATEGORIA'];

			if($id_permiso==""){
				$permisos = $permisos->insertarPermisos($usuario, $modulo,$id_categoria,$solo_sede,$solo_lectura,$reg_prop);
				echo json_encode(array('msg' => 'insertado'));
			}else if($id_permiso!=""){
				$permisos = $permisos->editarPermiso($id_permiso, $solo_sede,$solo_lectura,$reg_prop);
				echo json_encode(array('msg' => 'editado'));
			}
		}
	}
}
?>