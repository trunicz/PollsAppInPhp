<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita25531f364e78802485d087a89171457
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Trnx\\Polls\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Trnx\\Polls\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInita25531f364e78802485d087a89171457::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita25531f364e78802485d087a89171457::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita25531f364e78802485d087a89171457::$classMap;

        }, null, ClassLoader::class);
    }
}
