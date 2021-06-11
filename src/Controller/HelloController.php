<?php

namespace App\Controller;

use Twig\Environment;
use App\Taxes\Calculator;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /** 
     * @Route("/hello/{prenom?world}", name="hello")
    */
    public function hello(LoggerInterface $logger, Calculator $calculator, Slugify $slugify, Environment $twig, $prenom = "world")
    {
        $slugify = new Slugify();
        dump($twig);
        dump($slugify->slugify("Hello World"));
        
        $logger->info("Mon message de log");
        
        $tva = $calculator->calcul(100);
        dump($tva);
        return new Response("Hello $prenom");
    }
}