<?php
namespace App\Services;


/**
 * Class Fetcher
 * @package App\Services
*/
class Fetcher
{

    /** @var string  */
    private $url = 'http://www.geoplugin.net/php.gp?ip=';


    /**
     * @param string $ip
     * @return mixed
    */
    public function getLocation(string $ip)
    {
        return unserialize(file_get_contents($this->url) . $ip);
    }
}