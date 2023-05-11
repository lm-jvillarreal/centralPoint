<?php namespace App\Libraries;
class Functions
{
    public function template($route)
    {
        $template['head'] = view('templates/head');
        $template['header'] = view('templates/header');
        $template['footer'] = view('templates/footer');
        $template['footer2'] = view('templates/footer2');
        $template['menuV'] = view($route.'/menuV');

        return $template;
    }
}
?>
