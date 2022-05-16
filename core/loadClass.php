<?php
namespace core;

/**
 * Class loadClass
 * @package core
 */
class loadClass
{

    private $prefixDirsPsr4;

    /**
     * 注册一个PSR-4目录到命名空间
     * @param string       $prefix  命名空间前缀，必须以命名空间分隔符'\\'结束
     * @param array|string $path    PSR-4的基础目录
     */
    public function setPsr4($prefix,$paths){
        if(!$prefix){
            return $paths;
        }else{
            $length = strlen($prefix);
            //没有\\分隔符结束返回异常
            if('\\' !== $prefix[$length-1]){
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator");
            }
            $this->prefixDirsPsr4[$prefix] =  $paths;
        }
    }

    public function findFile($class,$ext = '.php'){
        //var_dump($class.'<br>');
        //最顶层的命名空间
        $prefix = substr($class,0,strpos($class,'\\')+1);
        if(array_key_exists($prefix,$this->prefixDirsPsr4)){
            //自动加载目录的标准路径
            $filePath = strtr(APP_PATH.$class, '\\', '/').$ext;
            return $filePath;
        }
        return false;
    }

    /**
     * 引入文件
     * @param string $filePath
     */
    public function includeFile($filePath){
        if(is_file($filePath)){
            //包含引入，如果是多次引入不同的文件include比require效率更改高
            include $filePath;
        }
    }

}