<?php
namespace OC\PlatformBundle\Repository;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Doctrine\ORM\EntityRepository;
// N'oubliez pas ce use
use Doctrine\ORM\QueryBuilder;

class ApplicationRepository extends EntityRepository
{
    

    public function getApplicationsWithAdvert($limit)
        {
            $qb = $this->createQueryBuilder('a');
            
            $qb
                    ->innerJoin('a.advert','ad')
                    ->addSelect('ad')
                    ->SetMaxResults($limit)
            ;
            
            return $qb
                    ->getQuery()
                    ->getResult()
                    ;
        }   
}