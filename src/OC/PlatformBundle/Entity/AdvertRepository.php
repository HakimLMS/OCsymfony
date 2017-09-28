<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;
// N'oubliez pas ce use
use Doctrine\ORM\QueryBuilder;

class AdvertRepository extends EntityRepository
{
  public function whereCurrentYear(QueryBuilder $qb)
  {
    $qb
      ->andWhere('a.date BETWEEN :start AND :end')
      ->setParameter('start', new \Datetime(date('Y').'-01-01'))  // Date entre le 1er janvier de cette année
      ->setParameter('end',   new \Datetime(date('Y').'-12-31'))  // Et le 31 décembre de cette année
    ;
  }
  
  public function getAdvertWithCategories(array $categoryNames)
  {
      $queryBuilder = $this->createQueryBuilder('a');
      
       //on fait une jointure avec l'entité catégories avec pour alias C
      
      $queryBuilder
              ->innerJoin('a.categories','c')
              ->addSelect('c') // on rajoute c à la selection du query builder
      // donc la on a toutes les entités advert et catégories dans le Querybuilder
      ;
      // on filtre avec IN
      $queryBuilder->where($queryBuilder->expr()->in('c.name', $categoryNames));        
      // La syntaxe du IN et d'autres expressions se trouve dans la documentation Doctrine      
       
      
      return $queryBuilder
              ->getQuery()
              ->getResult()
              ;
  }
  
}