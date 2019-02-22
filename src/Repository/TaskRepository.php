<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use \Doctrine\ORM\QueryBuilder;

/**
* @method Task|null find($id, $lockMode = null, $lockVersion = null)
* @method Task|null findOneBy(array $criteria, array $orderBy = null)
* @method Task[]    findAll()
* @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class TaskRepository extends ServiceEntityRepository
{
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, Task::class);
  }

  public function whereUser(User $user)
  {
    $qb= $this->createQueryBuilder('t')
    ->join('t.users', 'u')
    ->andWhere('u.id = :val')
    ->setParameter('val', $user);

    return $qb;
  }

  public function findByUser(User $user)
  {
    $qb=$this->whereUser($user);

    return $qb->getQuery()
    ->getResult();

  }

  public function findByUserDate(User $user)
  {
    $qb=$this->whereUser($user);
    $qb= $this->whereNoValidated($qb);
    $qb= $this->whereDateNow($qb);

    return $qb->getQuery()
    ->getResult();
  }

  public function findByUserDateLate(User $user)
  {
    $qb=$this->whereUser($user);
    $qb=$this->whereDateInf($qb);


    return $qb->getQuery()
    ->getResult();
  }

  public function whereNoValidated(QueryBuilder $qb)
  {
    $qb->andWhere('t.validated= :validated_value')
    ->setParameter('validated_value', '0');

    return $qb;
  }

  public function whereDateNow(QueryBuilder $qb)
  {
    $qb->andWhere('t.date = :date_value')
    ->setParameter('date_value', new \DateTime(date("Y-m-d")));

    return $qb;
  }

  public function whereDateInf(QueryBuilder $qb)
  {
    $qb->andWhere('t.date < :date_value_inf')
    ->setParameter('date_value_inf', new \DateTime(date("Y-m-d")));

    return $qb;
  }

  // /**
  //  * @return Task[] Returns an array of Task objects
  //  */
  /*
  public function findByExampleField($value)
  {
  return $this->createQueryBuilder('t')
  ->andWhere('t.exampleField = :val')
  ->setParameter('val', $value)
  ->orderBy('t.id', 'ASC')
  ->setMaxResults(10)
  ->getQuery()
  ->getResult()
  ;
}
*/

/*
public function findOneBySomeField($value): ?Task
{
return $this->createQueryBuilder('t')
->andWhere('t.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
*/
}
