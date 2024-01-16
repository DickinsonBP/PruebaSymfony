<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SupplierController
{
    /**
      * @Route("/")
    */
    public function homepage(): Response
    {
        return new Response('Title: PB and Jams');
    }


    /**
      * @Route("/browse/{slug}")
    */
    public function browse(string $slug = null): Response
    {
      //The $slug = null indicates that the $slug variable can be optional at the url
      //$title = u(str_replace('-', ' ', $slug))->title(true);
      if($slug){
        $title = 'Genere: '.str_replace('-', ' ', $slug);
      }else $title = 'All Generes';

      return new Response($title);
    }
}