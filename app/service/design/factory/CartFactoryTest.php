<?php
namespace app\service\design\factory;

use app\service\design\factory\Cart;

/**
 * 购物车工厂模式测试类
 * Class FactoryTest
 */
class CartFactoryTest
{
    public static function build(){
        $cart = new Cart();
        return $cart;
    }
}





