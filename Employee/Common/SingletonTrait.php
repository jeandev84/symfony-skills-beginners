<?php
namespace Framework;


/**
 * Trait SingletonTrait
 * @package Framework
*/
trait SingletonTrait
{

    private static $instance;

    /**
     * @return Employee|static
     */
    public static function instance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

}