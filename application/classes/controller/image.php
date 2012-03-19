<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Template_Default {

	public function action_index()
	{
            if($_FILES){
                $upload = new Model_Upload();
                if(!$upload->valid($_FILES))
                    die($upload->errors['image']);
                $upload->doSave();
                $this->addContent('next', '1');
            }
            
	}
        
        public function action_crop()
	{
          $crop = new Model_Crop();
          $fPImg = $crop->getFullPath('temp');
            if($_POST){
                if(!$crop->valid($_POST))
                    die(var_dump($crop->errors));
                $crop->doSave($fPImg);
                $this->addContent('next', '2');
            }else{
                $this->addContent('image', $fPImg);
            }
	}
        
        public function action_edit()
	{

        }
        
        public function action_flyimg(){
            $id = (int)$this->request->param('id');
            $this->response->headers("Content-Type", 'image/jpg');
            $edit = new Model_Edit();
            $img = $edit->dynImg($id);
            $this->response->body($img);
            $this->show(false);
                    
        }

} // End Index
