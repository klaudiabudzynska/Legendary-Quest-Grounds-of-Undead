<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestServerController
 * @Route("/test")
 */
class TestServerController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request){

        return new Response(
            "<!DOCTYPE html><html lang='pl'>
                        <head><title>Test</title></head>
                        <body><h1>Działa :D</h1></body></html>"
        );
    }
}