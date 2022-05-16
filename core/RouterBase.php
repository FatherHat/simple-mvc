<?php
namespace core;



class RouterBase{

    public function location(){

        $this->router();
    }

    /**
     * 路由在加载方法
     * @des 需要在nginx服务器配置所有请求都转到index.php文件，由代码来处理请求
     */
    private function router(){
        //重定向URL
        if(isset($_SERVER['REDIRECT_URL'])){
            $url = $_SERVER['REDIRECT_URL'];
        }else{
            //请求URL
            $url = $_SERVER['REQUEST_URI'];
        }
        //返回str中?的位置
        $position = strpos($url,'?');
        //获取域名后的控制器类名和方法
        $url = $position === false ? $url : substr($url,0,$position);
        $url = trim($url,'/');

        if($url){
            //走URL指定的控制器
            $urlArr = explode('/' ,$url);
            $controllerName  = ucfirst($urlArr[0]); //首字母转为大写
            $controllerAction = $urlArr[1];
        }else{
            //走默认Index控制器
            $controllerName  = 'Index';
            $controllerAction = 'index';
        }
        $controller = 'app\\controller\\'.$controllerName.'Controller';
        //检测类和方法是否存在
        if(!class_exists($controller)){
            exit($controller.'不存在');
        }
        if(!method_exists($controller,$controllerAction)){
            exit($controllerAction.'不存在');
        }
        //实例化控制器类，如果该类没有实例化，会在入口的注册函数自动加载
        $dispatch = new $controller();
        $dispatch->$controllerAction();
    }


}