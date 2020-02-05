<?php

namespace App\Controller;

use App\Services\DateManager;
use App\Services\Fetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController
 * @package App\Controller
*/
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param Request $request
     * @param Fetcher $fetcher
     * @param DateManager $dateManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, Fetcher $fetcher, DateManager $dateManager)
    {
        /* dump($request->getClientIp()); */

        $result = $fetcher->getLocation($request->getClientIp()); /* dump($result); */
        $date = $dateManager->getDateFromTimezone($result['geoplugin_timezone']);
        dump($date);



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
