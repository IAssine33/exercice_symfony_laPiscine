<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
class pokemonesController extends AbstractController
{
    //permet donner un nom d'URL qui est "/pokémones"
    #[Route('/pokémones', name: 'list_pokemones')]
    public function listPokemones(){

        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true,
                'image' => 'https://eternia.fr/public/media//rb/artworks/007.png'
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/0/0c/Salamèche-RB.png'
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/d/de/Bulbizarre-RB.png/175px-Bulbizarre-RB.png'
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/b/be/Pikachu-RB.png/175px-Pikachu-RB.png'
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/019.png'
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/016.png'
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/013.png'
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false,
                'image' => 'https://www.pokepedia.fr/images/thumb/3/3c/Nosferapti-RB.png/175px-Nosferapti-RB.png',
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/6/61/Mewtwo-RB.png/175px-Mewtwo-RB.png'
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'image' => 'https://www.pokepedia.fr/images/thumb/a/ac/Ronflex-RB.png/175px-Ronflex-RB.png'
            ]

        ];
                                                         // donner une valeur a la variable
        return $this->render('page/pokemones.html.twig', ['pokemons' => $pokemons]);
    }

    #[Route('/categories_pokemones', name: 'list_categories_pokemones')]
    public function categories_pokemones(){
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

       /// return $this->render('pokemones.html.twig', ['categories' => $categories]);
        $html = $this->renderView('page/categories_pokemones.html.twig', [
            'categories' => $categories
        ]);

        return new Response($html, 200);


    }

    #[Route('/pokemonById', name: 'pokemon_by_id')]
    public function pokemon_by_id(){


        $request = Request::createFromGlobals();
        $idPokemon = $request->query->get("id");

        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => true,
                'image' => 'https://eternia.fr/public/media//rb/artworks/007.png'
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/0/0c/Salamèche-RB.png'
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/d/de/Bulbizarre-RB.png/175px-Bulbizarre-RB.png'
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/b/be/Pikachu-RB.png/175px-Pikachu-RB.png'
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/019.png'
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => true,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/016.png'
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false,
                'image' => 'https://www.media.pokekalos.fr/img/pokemon/sugimori/1G/013.png'
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => false,
                'image' => 'https://www.pokepedia.fr/images/thumb/3/3c/Nosferapti-RB.png/175px-Nosferapti-RB.png',
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true,
                'image' => 'https://www.pokepedia.fr/images/thumb/6/61/Mewtwo-RB.png/175px-Mewtwo-RB.png'
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false,
                'image' => 'https://www.pokepedia.fr/images/thumb/a/ac/Ronflex-RB.png/175px-Ronflex-RB.png'
            ]

        ];

        $pokemonFound = null;

        foreach ($pokemons as $pokemon) {
            if ($pokemon['id'] == $idPokemon) {
                $pokemonFound = $pokemon;
            }
        }
        return $this->render('page/pokemons_choice.html.twig', ['pokemon' => $pokemonFound]);
    }
}




