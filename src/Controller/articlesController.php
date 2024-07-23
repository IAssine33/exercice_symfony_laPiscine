<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
class articlesController extends AbstractController
{
    //permet donner un nom d'URL qui est "/articles"
    #[Route('/articles', name: 'list_articles')]
    public function listArticles(){

        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ]

        ];
                                                         // donner une valeur a la variable
        return $this->render('articles.html.twig', ['pokemons' => $pokemons]);
    }

    #[Route('/articles2', name: 'list_articles2')]
    public function articles2(){
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

       /// return $this->render('articles.html.twig', ['categories' => $categories]);
        $html = $this->renderView('articles2.html.twig', [
            'categories' => $categories
        ]);

        return new Response($html, 200);


    }
}




