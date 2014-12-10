<?php
/**
 * Created by PhpStorm.
 * User: Administrator_sk
 * Date: 2014/12/10
 * Time: 15:39AAA
 */
class Encode{
    /**
     * @param $code
     * @param string $message
     * @param array $data
     */
    //json 不支持GBK
    public static  function json($code,$message = "",$data=array()){
        if(!is_numeric($code)){
            return "";
        }
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        echo json_encode($result);
        exit;
    }
    //\n换行
    public static  function xml(){
        header("Content-Type:text/xml");
        $xml="<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml.="<root>\n";
        $xml.="<code>200</code>";
        $xml.="<message>message</message>";
        $xml.="</root>";
        echo $xml;
        exit;
    }
    public static function xmlEncode($code,$message,$data=array()){
        if(!is_numeric($code)){
            return"";
        }
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data,
        );
        header("Content-Type:text/xml");
        $xml="<?xml version='1.0' encoding='UTF-8'?>";
        $xml.="<root>";
        $xml.=self::xmlToEncode($result);
        $xml.="</root>";
        echo $xml;
        exit;
    }
    public static function xmlToEncode($data){
        $xml="";
        foreach($data as $key =>$value){
            $xml.="<{$key}>";#{}当成变量
            $xml.=is_array($value)?self::xmlToEncode($value):$value;
            $xml.="</{$key}>";
        }
        return $xml;

    }

}