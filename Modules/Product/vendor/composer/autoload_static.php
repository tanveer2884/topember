<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit35fbe37f1aac7bed2d8ebeb5d0dc653a
{
    public static $files = array (
        'e009e606c0a230693aaf5a55769dac37' => __DIR__ . '/../..' . '/src/Helpers/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Topdot\\Product\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Topdot\\Product\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit35fbe37f1aac7bed2d8ebeb5d0dc653a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit35fbe37f1aac7bed2d8ebeb5d0dc653a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit35fbe37f1aac7bed2d8ebeb5d0dc653a::$classMap;

        }, null, ClassLoader::class);
    }
}
