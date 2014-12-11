<?php
/**
 * Created by PhpStorm.
 * User: Administrator_sk
 * Date: 2014/12/10
 * Time: 15:39AAA
 */
class Encode{
    const JSON ="json";
    public static function show($code,$message ="",$data= array(),$type=self::JSON){
        if(!is_numeric($code)){
            return"";
        }
        $type=isset($_GET['format'])?$_GET['formate']:self::JSON;
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        if($type=="json"){
            self::json($code,$message,$data);
        exit;
        }elseif($type="array"){
            var_dump($result);
        }elseif($type="xml"){
            self::xmlToEncode($code,$message,$data);
        }else{
            #todo
        }
        exit;

    }
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
        $xml=$attr="";
        foreach($data as $key =>$value){
            if(is_numeric($key)){
                $attr="id='{$key}''";
                $key="item";
            }
            $xml.="<{$key}{$attr}>";#{}当成变量
            $xml.=is_array($value)?self::xmlToEncode($value):$value;
            $xml.="</{$key}>";
        }
        return $xml;

    }

}