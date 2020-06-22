<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita9102df2103137db251ebb0cf7462fef
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita9102df2103137db251ebb0cf7462fef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita9102df2103137db251ebb0cf7462fef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita9102df2103137db251ebb0cf7462fef::$classMap;

        }, null, ClassLoader::class);
    }
}
