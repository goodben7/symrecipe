<?php

namespace App\Repository;

use App\Entity\CoteL1Genie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoteL1Genie>
 *
 * @method CoteL1Genie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoteL1Genie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoteL1Genie[]    findAll()
 * @method CoteL1Genie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoteL1GenieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoteL1Genie::class);
    }

    public function save(CoteL1Genie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CoteL1Genie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return CoteL1Genie[] Returns an array of CoteL1Genie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CoteL1Genie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
