<?php
    namespace Back\UserBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class BabySitterRepository extends EntityRepository
    {
        public function filtre($country,$city,$gender,$languages,$smoker,$specialNeeds,$provideSickCare,$pets,$homeWorkHelp,$motCle)
        {
            $qb = $this->createQueryBuilder('b');
            $qb->where('b.validated = TRUE');
            if($country!='all')
                $qb->andWhere($qb->expr()->like("UPPER(b.country)", "UPPER('%" . $country . "%')"));
            if($city!='all')
                $qb->andWhere($qb->expr()->like("UPPER(b.city)", "UPPER('%" . $city . "%')"));
            if($gender!='all')
                $qb->andWhere($qb->expr()->like("UPPER(b.gender)", "UPPER('%" . $gender . "%')"));
            if($languages!='all')
                $qb->andWhere($qb->expr()->like("UPPER(b.languages)", "UPPER('%" . $languages . "%')"));
            if($smoker!='all')
                $qb->andWhere('b.smoker = :smoker')->setParameter('smoker',$smoker);
            if($specialNeeds!='all')
                $qb->andWhere('b.specialNeeds = :specialNeeds')->setParameter('specialNeeds',$specialNeeds);
            if($provideSickCare!='all')
                $qb->andWhere('b.provideSickCare = :provideSickCare')->setParameter('provideSickCare',$provideSickCare);
            if($pets!='all')
                $qb->andWhere('b.pets = :pets')->setParameter('pets',$pets);
            if($homeWorkHelp!='all')
                $qb->andWhere('b.homeWorkHelp = :homeWorkHelp')->setParameter('homeWorkHelp',$homeWorkHelp);
            if (!is_null($motCle))
            {
                $mots = explode('+', $motCle);
                foreach ($mots as $mot)
                {
                    $orX=$qb->expr()->orX();
                    $orX->add($qb->expr()->like("UPPER(b.firstName)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.lastName)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.address)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.religion)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.languages)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.country)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.city)", "UPPER('%" . $mot . "%')"));
                    $orX->add($qb->expr()->like("UPPER(b.gender)", "UPPER('%" . $mot . "%')"));
                    $andX = $qb->expr()->andX()->add($orX);
                }
                $qb->andWhere($andX);
            }
            return $qb->getQuery()->getResult();
        }

        public function last4BabySitter()
        {
            $qb = $this->createQueryBuilder('b');
            $qb->where('b.validated = TRUE')
                ->orderBy('b.id','desc')
                ->setMaxResults(4);
            return $qb->getQuery()->getResult();
        }



        public function getCountries()
        {
            $qb = $this->createQueryBuilder('b');
            $qb->select('DISTINCT b.country')
                ->where($qb->expr()->isNotNull('b.country'))
                ->orderBy('b.country','asc');
            return $qb->getQuery()->getResult();
        }
        public function getCities($country="all")
        {
            $qb = $this->createQueryBuilder('b');
            $qb->select('DISTINCT b.city')
                ->where($qb->expr()->isNotNull('b.city'))
                ->orderBy('b.city','asc');
            if($country!='all')
                $qb->andWhere($qb->expr()->like("UPPER(b.country)", "UPPER('%" . $country . "%')"));
            return $qb->getQuery()->getResult();
        }
    }
