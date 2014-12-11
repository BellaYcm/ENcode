<?php
/**
 * Created by PhpStorm.
 * User: Administrator_sk
 * Date: 2014/12/11
 * Time: 10:33
 */
class File{
    private  $_dir;
    const EXT=".php";
    public function __construct(){
        $this->_dir=dirname(__FILE__).'/files/';
    }
    public function cacheData($key,$value="",$path=""){
        $filename=$this->_dir.$path.$key.self::EXT;
        if($value!==""){
            if(is_null($value)){
                return @unlink($filename);
            }
            $dir=dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
           return file_put_contents($filename,json_encode($value));
        }
    if(!is_file($filename)){
        return FALSE;
    }else{
        return json_decode(file_get_contents($filename));
    }
}

}