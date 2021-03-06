<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34c2562cec44e707121e9ae39545d169
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Basket\\BasketClass\\Database\\' => 28,
            'Basket\\BasketClass\\BasketHandling\\' => 34,
            'Basket\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Basket\\BasketClass\\Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php/class/Database',
        ),
        'Basket\\BasketClass\\BasketHandling\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php/class/BasketHandling',
        ),
        'Basket\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34c2562cec44e707121e9ae39545d169::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34c2562cec44e707121e9ae39545d169::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
