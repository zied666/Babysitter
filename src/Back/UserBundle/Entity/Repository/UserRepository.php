<?php
    namespace Back\UserBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class UserRepository extends EntityRepository
    {
        public function findByRole($roles)
        {
            $qb = $this->createQueryBuilder('u');
            $orX = $qb->expr()->orX();
            foreach ($roles as $role)
                $orX->add( $qb->expr()->like('u.roles', "'%".$role."%'"));
            $qb->where($orX);
            return $qb->getQuery()->getResult();
        }
    }
