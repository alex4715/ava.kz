<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Imgfly extends Template_Default {

 public function action_index()
    {
        $id = $this->request->param('id');
        $this->show(FALSE);
        $this->response->headers("Content-Type", 'image/jpg');
        $img = Image::factory('upload/images.jpeg', 'imagick');
 
        $this->response->body($img);

    }

} // End Index
