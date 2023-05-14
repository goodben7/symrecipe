<?php

namespace App\Repository;

use App\Entity\EtudiantL1Genie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtudiantL1Genie>
 *
 * @method EtudiantL1Genie|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantL1Genie|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantL1Genie[]    findAll()
 * @method EtudiantL1Genie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantL1GenieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantL1Genie::class);
    }

    public function save(EtudiantL1Genie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EtudiantL1Genie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EtudiantL1Genie[] Returns an array of EtudiantL1Genie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EtudiantL1Genie
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
