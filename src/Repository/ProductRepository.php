<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
    public function findByBio($isBio): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.bio = :true')
            ->setParameter('true', $isBio)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(25)
            ->getQuery()
            ->getResult()
        ;
    }

        /**
        * @return Query
        */
    public function findAllVisible(ProductSearch $search): Query
    {
        $query = $this->findAll();



        return $query->getQuery();

    }

    public function filterFormCustomQuery(ProductSearch $search): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->setMaxResults(50);

        if ($search->getMinPrice()){
            $queryBuilder->andWhere('p.selling_price_ttc >= :minprice' )
                ->setParameter('minprice', $search->getMinPrice());
        }

        if ($search->getMaxPrice()){
            $queryBuilder->andWhere('p.selling_price_ttc <= :maxprice' )
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        $query = $queryBuilder->getQuery();
        return $query->getResult();
        }


//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
