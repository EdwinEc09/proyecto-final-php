<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2185d2f99bcd56787481d9357a5972d3
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
        'E' => 
        array (
            'Escor\\HospitalManagement\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
        'Escor\\HospitalManagement\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2185d2f99bcd56787481d9357a5972d3::$classMap;

        }, null, ClassLoader::class);
    }
}