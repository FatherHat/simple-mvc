<?php
namespace src;

/**
 * 配置管理类
 * @package think
 */
class ConfigClass
{
    /**
     * 配置参数
     * @var array
     */
    private $config = [];

    /**
     * 配置文件目录
     * @var string
     */
    private $path;

    /**
     * 配置文件后缀
     * @var string
     */
    private $ext;

    public function __construct(string $path='config/' ,string $ext='.php')
    {
        $this->path = $path ? :'';
        $this->ext  = $ext;
    }

    /**
     * 读取配置文件
     * @param $name string 文件名
     */
    public function getConfig($name){
        //文件路径
        $path = APP_PATH.$this->path.$name.$this->ext;
        if(!file_exists($path)){
            //抛出异常
            throw new \Exception('not found '.$path);
        }
        $config = require_once $path;

        return $config;
    }

}
