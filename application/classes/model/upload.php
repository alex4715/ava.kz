<?php defined('SYSPATH') or die('No direct script access.');

class Model_Upload extends Model_Image{
    
    private $_file;
    public $errors;
    
    public function valid($file){
        $this->_file = $file['image'];
        $validate = Validation::factory($file)
                ->rule('image', 'Upload::Valid')
                ->rule('image', 'Upload::type', array($this->_file, array('jpg','png','gif','jpeg')))
                ->rule('image', 'Upload::not_empty')
                ->rule('image', 'Upload::size', array($this->_file, '6M'));
        if(!$validate->check()){
            $this->errors = $validate->errors('upload');
            return false;
        }
        return true;  
    }
    
    public function doSave(){
        $fileName = $this->fileName();
        $file = Upload::save($this->_file,  $fileName.'.png', 'media/avatars/temp/');
        $this->save($file);
        unlink($file);
    }
   
}