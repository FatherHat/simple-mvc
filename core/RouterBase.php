<?php
namespace core;

/**
 * Class RouterBase
 * @package core
 */
class RouterBase{

    public function run(){
        $router = new RouterClass();
        $router->settUrl();
        $router->setController();
        $router->exists();
        $router->location();
    }

}