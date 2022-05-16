<?php
namespace core;

/**
 * Class load
 * @package load
 */
class Load{

    private static $loader;

    //需要加载的核心文件
//    private $dirs = [
//         APP_PATH.'core/RouterBase.php',
//         APP_PATH.'core/MySqlConnect.php',
//         APP_PATH.'app/helper.php',
//         APP_PATH.'src/ConfigClass.php',
//    ];

    public function __construct()
    {

        require APP_PATH.'core/loadClass.php';

        //注册自动加载函数，且无法注册时抛出异常，并且在放在队列头部优先加载
        spl_autoload_register('self::loadClass',true,true);

    }

    public function run(){
        //加载路由类型
        (new RouterBase())->location();
    }

    /**
     * 自动加载方法，当使用没注册的类时，自动加载
     * @param $class
     */
    public static function loadClass($class)
    {
        //懒加载核心文件和库  [命名空间 => 对应目录]
        $path = [
            "app\\" => "app/",
            "src\\" => "src/",
            "core\\" => "core/",
            "vendor\\" => "vendor/"
        ];
        $obj = new loadClass();
        foreach ($path as $prefix=>$path){
            //设置命名空间前缀和路径，以Psr4协议
            $obj->setPsr4($prefix,$path);
        }
        //返回文件路径
        if($file = $obj->findFile($class)){
            //引入文件
            $obj->includeFile($file);
        }
    }

}
