<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitefb7ae14dac259743b92432fc817cacf
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitefb7ae14dac259743b92432fc817cacf', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitefb7ae14dac259743b92432fc817cacf', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitefb7ae14dac259743b92432fc817cacf::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
