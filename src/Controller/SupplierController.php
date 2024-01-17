<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class SupplierController extends AbstractController
{
    /**
      * @Route("/")
    */
    public function homepage(): Response
    {

        $suppliers = [
          ['name' => 'Dickinson', 'surname' => 'Bedoya'],  
          ['name' => 'Anna', 'surname' => 'Gracia'],  
          ['name' => 'Paula', 'surname' => 'Andrea'],  
        ]; 

        return $this->render(
          'supplier/homepage.html.twig',
          [
            'title' => 'Proveedores',
            'suppliers' => $suppliers,
          ]
        );
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

      return $this->render(
        'supplier/browse.html.twig',
        [
          'title' => 'Buscar',
        ]
      );
    }
}