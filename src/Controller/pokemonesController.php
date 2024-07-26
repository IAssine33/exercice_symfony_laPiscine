<?php

declare(strict_types=1);
namespace App\Controller;

use App\Repository\PokemonRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class pokemonesController extends AbstractController
{

    private array $pokemons;

    function __construct()
    {
        $this -> pokemons = [
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

    }

    //permet donner un nom d'URL qui est "/pokémones"
    #[Route('/pokémones', name: 'list_pokemones')]
    public function listPokemones(){


                                                         // donner une valeur a la variable
        return $this->render('page/pokemones.html.twig', ['pokemons' => $this -> pokemons]);
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

    #[Route('/pokemonById/{idPokemon}', name: 'pokemon_by_id')]
    public function pokemon_by_id($idPokemon){


        $pokemonFound = null;

        foreach ($this -> pokemons as $pokemon) {
            if ($pokemon['id'] === (int)$idPokemon) {
                $pokemonFound = $pokemon;
            }
        }
        return $this->render('page/pokemons_choice.html.twig', ['pokemon' => $pokemonFound]);
    }

    #[Route('/list_pokemon_bdd', name: 'list-pokemon-bdd')]
    //            "autowiere" -> param1(instancier) (dans) param2(variable)
    public function listPokemonBdd(PokemonRepository $pokemonRepository){

        return $this->render('page/list_pokemon_bdd.html.twig', ['pokemons' => $pokemonRepository->findAll()]);
    }

    #[Route('/pokemonById_bdd/{idPokemon}', name: 'pokemon_by_id_bdd')]

    public function pokemon_by_id_bdd($idPokemon, PokemonRepository $pokemonRepository){

        return $this -> render('page/pokemons_choiceBdd.html.twig', ['pokemon' => $pokemonRepository->find($idPokemon)]);
    }

    #[Route('/search_pokemon_bdd', name: 'search_pokemon_bdd')]
    public function search_pokemon_bdd(Request $request, PokemonRepository $pokemonRepository)
    {
        $pokemonFound = null;

        if ($request->request->has('title')) {

            $titleSearched = $request->request->get('title');
            $pokemonFound = $pokemonRepository->findOneBy(['title' => $titleSearched]);

            if (!$pokemonFound) {
                $html = $this->renderView('page/404.html.twig');
                return new Response($html, 404);
            }

        }


        return $this->render('page/pokemon_searched.html.twig', ['pokemon' => $pokemonFound]);


    }
}




