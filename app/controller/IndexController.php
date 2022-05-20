<?php
namespace app\Controller;

use core\Controller;
use app\model\TestModel;
use VendorTest;
use app\service\PersonClass;


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

    public function person(){
        //实例化一个类，得到一个该类的对象
        $person = new PersonClass();

        $b = $person;
        $b->setAge(20);

        var_dump($b->addAge());
        var_dump($b->addAge());
        $b->unsetAge();
        $person = new PersonClass();
        var_dump($person->addAge());
        //var_dump($b->addAge());
    }



}