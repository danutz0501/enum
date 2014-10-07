<?php

namespace DanielCosta\Enum;

/**
* Class EnumFixture
*
* @package SellerCenter\MiddleWare\Common
* @author Daniel Costa
* @method static EnumFixture FOO()
* @method static EnumFixture BAR()
* @method static EnumFixture NUMBER()
*/
class EnumFixture extends Enum
{
    const FOO = "foo";
    const BAR = "bar";
    const NUMBER = 42;
}
