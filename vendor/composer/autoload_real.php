<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitad0eeb5d507c0f2b94d88cc50f6f698e
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitad0eeb5d507c0f2b94d88cc50f6f698e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitad0eeb5d507c0f2b94d88cc50f6f698e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitad0eeb5d507c0f2b94d88cc50f6f698e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}