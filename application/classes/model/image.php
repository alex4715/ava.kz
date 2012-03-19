<?php defined('SYSPATH') or die('No direct script access.');

class Model_Image {

    private $_newFileName;
    private $_media;
    
    public function __construct() {
        $DIR = 'media/avatars/';
	$this->_media['temp']     = $DIR.'temp/';
	$this->_media['original'] = $DIR.'original/';
	$this->_media['end']      = $DIR.'end/';
        $this->createPath($this->_media);
        
    }
    
    public function fileName() {
        $this->_newFileName = md5(time());
        $this->getFolder($this->_newFileName);
        Cookie::set('n', $this->_newFileName);
        return true;
    }
    
    public function getOfCookieFileName(){
        return ($this->_newFileName == '')?Cookie::get('n'):$this->_newFileName;
    }
    
    public function getFolder($fN){
        return substr($fN, 0, 7).'/';
    }
    
    public function getPath($path = 'temp'){
        return $this->_media[$path].$this->getFolder($this->getOfCookieFileName());
    }
    
    public function getFullPath($path){
        return $this->getPath($path).$this->getOfCookieFileName().'.jpg';
    }
    
    public function createPath($paths = array()){
         foreach ($paths as $path)
                if (!file_exists($path))
                    @mkdir($path, 0777, TRUE);
    }
    
    public function save($file = NULL, $path = 'temp', $crop = array()){
        $fPath = $this->getPath($path);
        $this->createPath(array($fPath));
        $img = Image::factory($file, 'imagick');
        if($path == 'temp')
            $img->resize(600);
        elseif($path == 'crop') {
            $img->crop($crop['x1'], $crop['x2'], $crop['y1'], $crop['y2'])
                ->rotate($crop['r']);
            if($crop['h'] === 17)
                $img->flip($crop['h']);
            if($crop['g'] === 18)
                $img->flip($crop['g']);
            $this->removeImg($this->getOfCookieFileName());
        }
            
            $img->save($this->getFullPath($path));
            
    }
    
    public function removeImg($fN, $path = 'temp'){
        $fullPath = $this->getPath($path);
        if ($fN != '')			
            if (file_exists($fullPath.$fN.'.jpg')){				
                @unlink($fullPath.$fN.'.jpg');
                @rmdir($fullPath);
        }
     }
    
    
}