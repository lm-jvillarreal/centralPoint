<?php

namespace App\Controllers;

use App\Database\Seeds\Usuario;
use App\Libraries\Functions;
use App\Models\Usuarios;
use CodeIgniter\HTTP\Response;

class login extends BaseController
{
	public function index()
	{
		$funciones = new Functions();
		if (session("logeado") == "SI") {
			return redirect()->to(base_url('/controlPanel'));
		} else {
			return view('login/login');
		}
	}
	public function processLogin()
	{
		if (!$this->validate([
			'usuario' => [
				'rules' => 'required|is_not_unique[cfg_usuarios.NOMBRE_USUARIO]',
				'errors' => [
					'required' => 'Debes ingresar un nombre de usuario',
					'is_not_unique' => 'El usuario no existe'
				]
			],
			'pass' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Debes ingresar una contraseña'
				]
			]
		])) {
			$usuario = $this->validator->getError('usuario');
			$pass = $this->validator->getError('pass');
			$errores = [
				'usuario' => $usuario,
				'pass' => $pass
			];
			echo json_encode($errores);

			//enviar código de error por headers
			$response = service('response');
			$response->setStatusCode(400);
			$response->setHeader('Content-type', 'text/html');
			$response->noCache();
			$response->send();
		} else {
			$usuario = $this->request->getPost('usuario');
			$password = $this->request->getPost('pass');
			$Usuario = new Usuarios();
			$datosUsuario = $Usuario->obtenerUsuario(['NOMBRE_USUARIO' => $usuario]);
			if (count($datosUsuario) > 0 && password_verify($password, $datosUsuario[0]['PASSWORD']) && $datosUsuario[0]['ACTIVO'] == 1) {
				$datosPerfil = $Usuario->obtenerPerfil($datosUsuario[0]['ID_PERFIL']);
				$datosSede = $Usuario->obtenerSede($datosUsuario[0]['ID_SEDE']);
				$nombrePersona = $datosUsuario[0]['NOMBRE'] . ' ' . $datosUsuario[0]['AP_PATERNO'];
				$data = [
					"logeado" => "SI",
					"id" => $datosUsuario[0]['ID'],
					"id_usuario" => $datosUsuario[0]['ID'],
					"id_persona" => $datosUsuario[0]['ID_PERSONA'],
					"nombre_persona" => $nombrePersona,
					"usuario" => $datosUsuario[0]['USUARIO'],
					"id_perfil" => $datosUsuario[0]['ID_PERFIL'],
					"nombre_perfil" => $datosPerfil[0]['NOMBRE'],
					"id_sede" => $datosUsuario[0]['ID_SEDE'],
					"nombre_sede" => $datosSede[0]['NOMBRE']
				];
				$session = session();
				$session->set($data);
				echo json_encode(["url" => base_url('/inicio')]);
				//return redirect()->to(base_url('/inicio'));
			} else {
				echo json_encode(['msg' => 'La contraseña que ingresó es incorrecta']);
				$response = service('response');
				$response->setStatusCode(401);
				$response->setHeader('Content-type', 'text/html');
				$response->noCache();
				$response->send();
			}
		}
	}
	public function logout()
	{
		$data = [
			'logeado' => "NO"
		];
		$session = session();
		$session->set($data);
		return view('login/login');
	}
	public function validarsesion($ruta = null)
	{
		$funciones = new Functions();
		$Usuario = new Usuarios();
		if (session("logeado") == "SI") {
			$acceso = $Usuario->obtenerAcceso($ruta, session("id"));
			if ($acceso == 0) {
				return redirect()->to(base_url('/inicio'));
			} else {
				$ruta = $Usuario->obtenerRuta($ruta);
				$nombre = explode('/', $ruta[0]['RUTA']);
				$template = $funciones->template($nombre[0]);
				return view($ruta[0]['RUTA'], $template);
			}
		} else {
			return redirect()->to(base_url('/inicio'));
		}
	}
	public function plantilla()
	{
		return view('login/login_');
	}
	public function cambiarPass(){
		return $this->validarsesion(13);
	}
	public function misDatos(){
		return $this->validarsesion(14);
	}
}
?>
