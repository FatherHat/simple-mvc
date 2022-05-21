<?php
namespace app\Controller;

use app\service\design\factory\Cart;
use app\service\design\factory\CartFactoryTest;
use app\service\PersonClass;

class DesignController{

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

    /**
     * 简单工厂模式
     * 核心是把创建实例和使用实例分开，实现低耦合，高内聚
     */
    public function factoryTest(){
        //build()返回的是否是Cart的实例
        if(CartFactoryTest::build() instanceof Cart){
            var_dump('yes');
        }else{
            var_dump('no');
        }
    }
}