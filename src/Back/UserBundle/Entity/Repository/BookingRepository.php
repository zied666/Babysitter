<?php
namespace Back\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class BookingRepository extends EntityRepository
{
    public function filtre($status = null)
    {
        $qb = $this->createQueryBuilder('b');
        if (!is_null($status))
            $qb->where('b.status = :status')->setParameter('status',$status);
        $qb->orderBy('b.id','DESC');
        return $qb->getQuery()->getResult();
    }

}
