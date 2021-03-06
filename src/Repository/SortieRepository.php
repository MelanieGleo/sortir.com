<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function InfosSorties($filters = null): array
    {
        $queryBuilder = $this->createQueryBuilder("s");
        if($filters != null){
            $queryBuilder->andWhere('s.site IN(:sites)')
                ->setParameter(':sites', array_values($filters));
        }
        $query = $queryBuilder->getQuery();
        $sorties = $query->getResult();
        return $sorties;
    }

    public function detailSorties($id): ?Sortie
    {
        $queryBuilder = $this->createQueryBuilder("s")
            ->addSelect("p")
            ->addSelect("s2")
            ->addSelect("p2")
            ->andWhere('s.id = :val')
            ->setParameter('val', $id)
            ->join("s.participOrga", 'p')
            ->join("s.site", 's2')
            ->leftJoin("s.participants", "p2");
        $query = $queryBuilder->getQuery();
        $sorties = $query->getOneOrNullResult();
        return $sorties;
    }
    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
