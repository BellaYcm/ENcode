<?php

//单例模式

class DbConn
{

    //保存类的实例的静态方法变量
    private static $_instance = null;
    protected static $_counter = 0;
    protected $_db;

//私有化构造函数，不允许外部创建实例
//外部加载了这个页面通过静态方法去调用
//单例模式构造方法声明为私有
    private function __construct()
    {
        self::$_counter += 1;
    }

//访问这个实例的公共静态方法
    static public function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();  //自己New 自己
        }
        return self::$_instance;
    }

    public function connect()
    {
        echo "connected: " . (self::$_counter) . "n";
        return $this->_db;
    }

}

/*
* 不使用单例模式时，删除构造函数的private后再测试，第二次调用构造函数后，_counter变成2
*/
// $conn = new DbConn();
// $conn->connect();
// $conn = new DbConn();
// $conn->connect();

//使用单例模式后不能直接new对象，必须调用getInstance获取
    $conn = DbConn::getInstance();
    $db = $conn->connect();
//第二次调用是同一个实例，_counter还是1
    $conn = DbConn::getInstance();
    $db = $conn->connect();

?>