<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController
 * @package App\Controller
 *
 * @Route("/home", name="home.")
*/
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/helloUser/{name?}", name="hello_user")
     * @param Request $request
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*
       Route("/helloUser/{name?}", name="hello_user", method={"GET", "POST"}"
       public function helloUser($name) {}
       public function helloUser(Request $request) {}
    */
    public function helloUser(Request $request, $name)
    {
       // $name = $request->get('name');

       //$form = $this->createFormBuilder()
                    //->add();
       return $this->render('home/greet.html.twig', [
           'name' => $name,
           'form' => $form->createView()
       ]);
    }
}
