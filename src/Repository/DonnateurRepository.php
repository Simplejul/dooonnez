<?php

namespace App\Repository;

use App\Entity\Donnateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Donnateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donnateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donnateur[]    findAll()
 * @method Donnateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonnateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Donnateur::class);
    }

   /**
    * @return Donnateur[] Returns an array of Donnateur objects
    */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($value): ?Donnateur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
