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

        public function countByRole($roles)
        {
            $qb = $this->createQueryBuilder('u');
            $qb->select('count(u.id)');
            $orX = $qb->expr()->orX();
            foreach ($roles as $role)
                $orX->add( $qb->expr()->like('u.roles', "'%".$role."%'"));
            $qb->where($orX);
            return $qb->getQuery()->getSingleScalarResult();
        }

        public function findBabySitter($validated='all')
        {
            $qb = $this->createQueryBuilder('u');
            $qb->join('u.babysitter','b');
            if($validated!='all')
                $qb->where('b.validated = :status')->setParameter('status',$validated);
            return $qb->getQuery()->getResult();
        }
    }
