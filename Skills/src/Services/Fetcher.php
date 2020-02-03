<?php
namespace App\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Fetcher
 * @package App\Services
*/
class Fetcher
{

    /** LoggerInterface $logger , public function __construct(LoggerInterface $logger) {} */
    /** \Swift_Mailer $mailer , public function __construct(\Swift_Mailer $mailer) {} */

    private $forbiddenLink;

    private $container;

    /**
     * Fetcher constructor.
     * @param ContainerInterface $container
     * @param $forbiddenLink
     */
    public function __construct(ContainerInterface $container, $forbiddenLink)
    {
        var_dump($forbiddenLink);
        $this->forbiddenLink = $forbiddenLink;
        $this->container = $container;
    }

    /**
     * @param $url
     * @return string
    */
    public function get($url)
    {
       $uploads_dir = $this->container->getParameter('forbiddenLink');
       var_dump($uploads_dir);

       if($url === $this->forbiddenLink)
       {
           return false;
       }

       // get the result from the api
       $result = file_get_contents($url);
       return json_decode($result, true);
    }
}