<?php
namespace app\service;

class PersonClass
{

    public $name;

    public static $age;

    public function setAge($age){
        self::$age = $age;
    }

    public function addAge(){
        self::$age ++;

        return self::$age;
    }

    //静态属性和静态方法是没办法使用unset()的
    public function unsetAge(){
        self::$age = null;
    }
}