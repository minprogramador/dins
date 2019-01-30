<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit07327c7ece32297bdbdd9859e2600e9d
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dins\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dins\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Dins',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit07327c7ece32297bdbdd9859e2600e9d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit07327c7ece32297bdbdd9859e2600e9d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}