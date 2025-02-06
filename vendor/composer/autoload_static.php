<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a79d75ea4632f3cc0c627bb668e6979
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0a79d75ea4632f3cc0c627bb668e6979::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0a79d75ea4632f3cc0c627bb668e6979::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0a79d75ea4632f3cc0c627bb668e6979::$classMap;

        }, null, ClassLoader::class);
    }
}
