<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621
{
    public static $files = array (
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        'f598d06aa772fa33d905e87be6398fb1' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/bootstrap.php',
        'def43f6c87e4f8dfd0c9e1b1bab14fe8' => __DIR__ . '/..' . '/symfony/polyfill-iconv/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Idn\\' => 26,
            'Symfony\\Polyfill\\Iconv\\' => 23,
        ),
        'R' => 
        array (
            'Registration\\Informations\\' => 26,
            'Registration\\DatabaseHandling\\' => 30,
            'Registration\\' => 13,
        ),
        'E' => 
        array (
            'EmailsSending\\' => 14,
            'Egulias\\EmailValidator\\' => 23,
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Lexer\\' => 22,
            'DendoJitenshaBackend\\User\\' => 26,
            'DendoJitenshaBackend\\DbManager\\' => 31,
            'DendoJitenshaBackend\\DataValidator\\' => 35,
            'DendoJitenshaBackend\\' => 21,
            'DatabaseInformations\\' => 21,
        ),
        'C' => 
        array (
            'Connection\\ConnectionVerif\\DatabaseHandling\\' => 44,
            'Connection\\ConnectionChecks\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Idn\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-idn',
        ),
        'Symfony\\Polyfill\\Iconv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-iconv',
        ),
        'Registration\\Informations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/Informations',
        ),
        'Registration\\DatabaseHandling\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/DatabaseHandling',
        ),
        'Registration\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class',
        ),
        'EmailsSending\\' => 
        array (
            0 => __DIR__ . '/../..' . '/emailsSending',
        ),
        'Egulias\\EmailValidator\\' => 
        array (
            0 => __DIR__ . '/..' . '/egulias/email-validator/src',
        ),
        'Doctrine\\Common\\Lexer\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/lexer/lib/Doctrine/Common/Lexer',
        ),
        'DendoJitenshaBackend\\User\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/User',
        ),
        'DendoJitenshaBackend\\DbManager\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/DbManager',
        ),
        'DendoJitenshaBackend\\DataValidator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/DataValidator',
        ),
        'DendoJitenshaBackend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class',
        ),
        'DatabaseInformations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/database/dbInformations',
        ),
        'Connection\\ConnectionVerif\\DatabaseHandling\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/DatabaseHandling/Connection',
        ),
        'Connection\\ConnectionChecks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/class/Informations',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621::$classMap;

        }, null, ClassLoader::class);
    }
}
