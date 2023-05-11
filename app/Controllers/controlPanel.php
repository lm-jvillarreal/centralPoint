<?php
 namespace App\Controllers;
 use App\Libraries\Functions;
 use App\Models\PanelControl;

 class controlPanel extends BaseController{
     public function index(){
      if (session("logeado") == "SI") {
        $funciones = new Functions();
        $content=new PanelControl();
        $contenido['categorias']=$content->Categorias(session("id"));
        $contenido['template']=$funciones->template('controlPanel');
        return view('controlPanel/index_',$contenido);
      } else {
        return view('login/login');
      }
     }
 }

?>