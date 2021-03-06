<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CARepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CARepository extends EntityRepository
{
	public function findByNomCA($page, $resultatsParPage)
	{
  		$listCA = $this->createQueryBuilder('ca')
                           ->orderBy('ca.nomCA', 'ASC')
                           ->setFirstResult( ($page-1)*$resultatsParPage )
                           ->setMaxResults( $resultatsParPage )
  		;

  		return $listCA
    		->getQuery()
    		->getResult()
  		;
	}

  public function findByUser($page, $resultatsParPage, $user) {

      $queryBuilder = $this->createQueryBuilder('ca')
        ->innerJoin('ca.users', 'user')
        ->where('user.id = :user')
        ->setParameter('user', $user->getId())
        ->orderBy('ca.nomCA', 'ASC')
        ->setFirstResult( ($page-1)*$resultatsParPage )
        ->setMaxResults( $resultatsParPage )
      ;

      $query = $queryBuilder->getQuery();

      // var_dump($query->getSQL());

      return $query->getResult();

  }
}
