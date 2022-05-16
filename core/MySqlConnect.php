<?php

/**
 * Class MySqlConnect
 * 创建mysql数据库连接，单例模式
 */
class MySqlConnect{
    //私有化构造函数，防止外部调用
    private function __construct(){}

    //私有化克隆函数，防止外部调用
    private function __clone(){}

    //私有化静态属性，进程初始化前，mysql连接信息存储在静态存储区中
    private static $connect = array();

    /**
     * 建立连接
     * @param $dbType enum  数据库连接类型,为了区分主从库连接,根据配置文件配置
     */
    public static function getMysqlConnect($dbType)
    {
        //mysql连接类型存在便返回
        if(key_exists($dbType ,self::$connect)){
            return self::$connect[$dbType];
        }

    }
}