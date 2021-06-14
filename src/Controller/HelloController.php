<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /** 
     * @Route("/hello/{prenom?world}", name="hello")
     */
    public function hello($prenom = "world"): Response
    {
        return $this->render("hello.html.twig",[
            'prenom' => $prenom
        ]);
    }
    /** 
     * @Route("/example", name="example")
     */
    public function example() : Response
    {
        return $this->render('example.html.twig', [
            'age' => 33
        ]);
    }


}