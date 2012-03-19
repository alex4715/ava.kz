<?php defined('SYSPATH') or die('No direct script access.');

class Template_Default extends Kohana_Controller_Kotwig {
    
    public $auto_render = TRUE;
    public $template = NULL;
    
    public function __construct(Request $request, Response $response) {
        parent::__construct($request, $response);
    }
    
    public function show($bool = TRUE){
        $this->auto_render = $bool;
    }
    
    public function view($page){
        $this->template->set_filename($page);
    }
    
    public function addContent($k, $v){
        Kohana_View::set_global($k, $v);
    }
    

}
