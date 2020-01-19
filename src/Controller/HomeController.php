<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        // request
        // $name = $request->get('name');

        /*-------------------------------------------------------------
         * explain difference between createForm & createFormBuilder
        --------------------------------------------------------------*/
        $form = $this->createFormBuilder()
                     ->add('fullname', TextType::class)
                     ->getForm();


        $person = [
           'name' => 'Jean-Claude',
           'lastname' => 'Yao',
           'age' => 35
        ];

       return $this->render('home/greet.html.twig', [
          'person' => $person,
           'user_form'  => $form->createView()
       ]);
    }
}
