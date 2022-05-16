<?php

use src\ConfigClass;

if (!function_exists('config')){
    /**
     * 读取配置文件信息
     * @param $name string 配置名文件名
     * @return mixed
     * @throws Exception
     */
    function config($name){
        //获取配置文件内容
        $config = (new ConfigClass())->getConfig($name);

        return $config;
    }
}
