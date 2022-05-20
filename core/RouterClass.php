<?php
namespace core;

class RouterClass
{
    //请求地址
    private $url;
    //控制器
    private $controller;
    //请求控制器名称
    private $controllerName;
    //请求控制器方法
    private $controllerAction;


    public function run(){
        $this->settUrl();
        $this->setController();
        $this->exists();
        $this->location();
    }

    /**
     * 请求url
     */
    public function settUrl(){
        if(isset($_SERVER['REDIRECT_URL'])){
            //重定向地址
            $this->url = $_SERVER['REDIRECT_URL'];
        }else{
            //请求地址
            $this->url = $_SERVER['REQUEST_URI'];
        }
    }

    /**
     * 设置控制器名和方法
     */
    public function setController(){
        //剪辑纯url地址
        $position = strpos($this->url,"?");
        $url = $position === false ? $this->url : substr($this->url,0,$position);
        $url = trim($url,"/");
        if($url){
            $url = explode("/",$url);
            //首字符转为大写
            $this->controllerName = ucfirst($url[0]);
            $this->controllerAction = $url[1];
        }else{
            //默认地址
            $this->controllerName = 'Index';
            $this->controllerAction = 'index';
        }
    }

    /**
     * 确认控制器是否存在
     */
    public function exists(){

        $this->controller = 'app\\controller\\'.$this->controllerName.'Controller';
        if(!class_exists($this->controller)){
            exit($this->controller."不存在");
        }elseif(!method_exists($this->controller,$this->controllerAction)){
            exit($this->controllerAction."不存在");
        }
    }

    /**
     * 定位到指定路由
     */
    public function location(){
        $controller = new $this->controller;
        $action     = $this->controllerAction;
        $controller->$action();
    }


}