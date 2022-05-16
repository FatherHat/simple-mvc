<?php
namespace app\Controller;

use core\Controller;
use app\model\TestModel;
use VendorTest;


class IndexController extends Controller{

    public function index(){
        echo 'this is index<br>';
        //调用指定方法，低版本有后门，慎用
        //$res = call_user_func([$this,'fuckYou'],1,2);
        
    }

    public function choice()
    {
        var_dump("lt was fate's choice");
    }

    public function lookMan()
    {
        $res = (new TestModel())->getMan();
        var_dump($res);
    }

}