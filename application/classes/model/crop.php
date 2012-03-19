<?php defined('SYSPATH') or die('No direct script access.');

class Model_Crop extends Model_Image{
    
    private $_post;
    public $errors;
    
    public function valid($post){
        $this->_post = $post;
        $validate = Validation::factory($post)
                
                  ->rule('x1', 'not_empty')
                  ->rule('x2', 'not_empty')
                  ->rule('y1', 'not_empty')
                  ->rule('y2', 'not_empty')
                  ->rule('h', 'not_empty')
                  ->rule('g', 'not_empty')
                  ->rule('r', 'not_empty')
                
                  ->rule('r', 'range', array($post['r'],1, 4))
                
                  ->rule('x1', 'numeric')
                  ->rule('x2', 'numeric')
                  ->rule('y1', 'numeric')
                  ->rule('y2', 'numeric')
                  ->rule('h', 'numeric')
                  ->rule('g', 'numeric')
                  ->rule('r', 'numeric')
                ;
        if(!$validate->check()){
            $this->errors = $validate->errors('post');
            return false;
        }
        return true;  
    }
    
    public function doSave(){
        $crop = $this->_post;
        switch ($crop['r']){
            case 1: $crop['r'] = 0; break;
            case 2: $crop['r'] = 90; break;
            case 3: $crop['r'] = 180; break;
            case 4: $crop['r'] = 270; break;
            default : die('От 1 до 4 как бы!!!');
        }
        $this->save($this->getFullPath('temp'), 'original', $crop);
    }
   
}