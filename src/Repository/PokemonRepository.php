<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // je crée une methode  pour chercher dans la base de données des entités Pokémon dont le titre contient juste une partie de son nom.
    public function findLikeTitle($search)
    {
        $queryBuilder = $this->createQueryBuilder('pokemon');

        // Construit la requête pour sélectionner les entités Pokémon
        $query = $queryBuilder->select('pokemon')
            ->where('pokemon.title LIKE :search') // Ajoute une condition pour le titre.
            ->setParameter('search', '%'.$search.'%') // Définit le paramètre de recherche avec des chiffres ou caractéres n'importe où au '%.milieu.%' .
            ->getQuery(); // Obtient l'objet requête
        // Exécute la requête et obtient les résultats sous forme de tableau
        $pokemons = $query->getArrayResult();

        // Retourne les résultats
        return $pokemons;
    }

    //    /**
    //     * @return Pokemon[] Returns an array of Pokemon objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pokemon
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
