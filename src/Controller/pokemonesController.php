<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        $pokemonsFound = [];

        if ($request->request->has('title')) {

            $titleSearched = $request->request->get('title');

            $pokemonsFound = $pokemonRepository->findLikeTitle($titleSearched);

            if (count($pokemonsFound) === 0) {
                $html = $this->renderView('page/404.html.twig');
                return new Response($html, 404);
            }

        }


        return $this->render('page/pokemon_searched.html.twig', ['pokemons' => $pokemonsFound]);
    }

    #[route('/pokemon/delete/{id}', name: 'delete_pokemon')]
    public function deletePokemon(int $id, PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager): Response
    {



       $pokemon = $pokemonRepository->find($id);

        if (!$pokemon) {

            $html = $this->renderView('page/404.html.twig');
            return new Response($html, 404);

        }

       $entityManager->remove($pokemon);

       $entityManager->flush();


       return $this->redirectToRoute('list-pokemon-bdd');



        }


        #[Route('/list_insert_pokemon_bdd', name: 'insert_pokemon_bdd')]
        public function insertPokemon(EntityManagerInterface $entityManager, Request $request): Response
        {

            $pokemon = null;

            if ($request->getMethod() === 'POST') {

                $title = $request->request->get('title');
                $description = $request->request->get('description');
                $type = $request->request->get('type');
                $image = $request->request->get('image');

                $pokemon = new Pokemon();

                $pokemon->setTitle($title);
                $pokemon->setDescription($description);
                $pokemon->setType($type);
                $pokemon->setImage($image);
                $entityManager->persist($pokemon);
                $entityManager->flush();


            }

            return $this->render('page/pokemon_insert_without_form.html.twig', ['pokemon' => $pokemon]);

        }
            #[Route('/pokemon/insert/form-builder', name: 'insert_formBuilder_pokemon_bdd')]
        public function insertFormBuilderPokemon(EntityManagerInterface $entityManager, Request $request): Response
        {
            // on a créé une classe de "gabarit de formulaire HTML" avec php bin/console make:form

            // je créé une instance de la classe d'entité Pokemon
           $pokemon = new Pokemon();

            // permet de générer une instance de la classe de gabarit de formulaire et de la lier avec l'instance de l'entité
           $pokemonForm = $this->createForm(PokemonType::class, $pokemon);

            // lie le formulaire avec la requête
           $pokemonForm->handleRequest($request);

            // si le formulaire a été envoyé et que ces données sont correctes
           if ($pokemonForm->isSubmitted() && $pokemonForm->isValid()) {
               $entityManager->persist($pokemon);
               $entityManager->flush();

           }
           return $this->render('page/pokemon_insert_formBuilder.html.twig', [ 'pokemonForm' => $pokemonForm->createView()]);
        }


        #[route('/pokemon/update/{id}', name: 'update_pokemon')]
        public function update_pokemon(int $id, PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager, Request $request): Response
        {

            $pokemon = $pokemonRepository->find($id);
            $pokemonUpdateForm = $this->createForm(PokemonType::class, $pokemon);

            $pokemonUpdateForm->handleRequest($request);

            if ($pokemonUpdateForm->isSubmitted() && $pokemonUpdateForm->isValid()) {
                $entityManager->persist($pokemon);
                $entityManager->flush();

                return $this->redirectToRoute('list-pokemon-bdd');

            }
            return $this->render('page/pokemon_update_form.html.twig', [ 'pokemonUpdateForm' => $pokemonUpdateForm->createView()]);
        }


}











