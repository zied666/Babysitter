<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibility
 *
 * @ORM\Table(name="b_babysitter_disponiblity")
 * @ORM\Entity
 */
class Disponibility
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lundi_1", type="boolean", nullable=true)
     */
    private $lundi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lundi_2", type="boolean", nullable=true)
     */
    private $lundi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lundi_3", type="boolean", nullable=true)
     */
    private $lundi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lundi_4", type="boolean", nullable=true)
     */
    private $lundi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mardi_1", type="boolean", nullable=true)
     */
    private $mardi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mardi_2", type="boolean", nullable=true)
     */
    private $mardi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mardi_3", type="boolean", nullable=true)
     */
    private $mardi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mardi_4", type="boolean", nullable=true)
     */
    private $mardi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mercredi_1", type="boolean", nullable=true)
     */
    private $mercredi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mercredi_2", type="boolean", nullable=true)
     */
    private $mercredi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mercredi_3", type="boolean", nullable=true)
     */
    private $mercredi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mercredi_4", type="boolean", nullable=true)
     */
    private $mercredi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jeudi_1", type="boolean", nullable=true)
     */
    private $jeudi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jeudi_2", type="boolean", nullable=true)
     */
    private $jeudi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jeudi_3", type="boolean", nullable=true)
     */
    private $jeudi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jeudi_4", type="boolean", nullable=true)
     */
    private $jeudi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi_1", type="boolean", nullable=true)
     */
    private $vendredi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi_2", type="boolean", nullable=true)
     */
    private $vendredi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi_3", type="boolean", nullable=true)
     */
    private $vendredi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi_4", type="boolean", nullable=true)
     */
    private $vendredi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi_1", type="boolean", nullable=true)
     */
    private $samedi1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi_2", type="boolean", nullable=true)
     */
    private $samedi2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi_3", type="boolean", nullable=true)
     */
    private $samedi3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi_4", type="boolean", nullable=true)
     */
    private $samedi4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche_1", type="boolean", nullable=true)
     */
    private $dimanche1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche_2", type="boolean", nullable=true)
     */
    private $dimanche2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche_3", type="boolean", nullable=true)
     */
    private $dimanche3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche_4", type="boolean", nullable=true)
     */
    private $dimanche4;
    
    public function __construct()
    {
        $this->lundi1=1;
        $this->lundi2=1;
        $this->lundi3=1;
        $this->lundi4=1;
        
        $this->mardi1=1;
        $this->mardi2=1;
        $this->mardi3=1;
        $this->mardi4=1;
        
        $this->mercredi1=1;
        $this->mercredi2=1;
        $this->mercredi3=1;
        $this->mercredi4=1;
        
        $this->jeudi1=1;
        $this->jeudi2=1;
        $this->jeudi3=1;
        $this->jeudi4=1;
        
        $this->vendredi1=1;
        $this->vendredi2=1;
        $this->vendredi3=1;
        $this->vendredi4=1;
        
        $this->samedi1=1;
        $this->samedi2=1;
        $this->samedi3=1;
        $this->samedi4=1;
        
        $this->dimanche1=1;
        $this->dimanche2=1;
        $this->dimanche3=1;
        $this->dimanche4=1;

    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lundi1
     *
     * @param boolean $lundi1
     *
     * @return Disponibility
     */
    public function setLundi1($lundi1)
    {
        $this->lundi1 = $lundi1;

        return $this;
    }

    /**
     * Get lundi1
     *
     * @return boolean
     */
    public function getLundi1()
    {
        return $this->lundi1;
    }

    /**
     * Set lundi2
     *
     * @param boolean $lundi2
     *
     * @return Disponibility
     */
    public function setLundi2($lundi2)
    {
        $this->lundi2 = $lundi2;

        return $this;
    }

    /**
     * Get lundi2
     *
     * @return boolean
     */
    public function getLundi2()
    {
        return $this->lundi2;
    }

    /**
     * Set lundi3
     *
     * @param boolean $lundi3
     *
     * @return Disponibility
     */
    public function setLundi3($lundi3)
    {
        $this->lundi3 = $lundi3;

        return $this;
    }

    /**
     * Get lundi3
     *
     * @return boolean
     */
    public function getLundi3()
    {
        return $this->lundi3;
    }

    /**
     * Set lundi4
     *
     * @param boolean $lundi4
     *
     * @return Disponibility
     */
    public function setLundi4($lundi4)
    {
        $this->lundi4 = $lundi4;

        return $this;
    }

    /**
     * Get lundi4
     *
     * @return boolean
     */
    public function getLundi4()
    {
        return $this->lundi4;
    }

    /**
     * Set mardi1
     *
     * @param boolean $mardi1
     *
     * @return Disponibility
     */
    public function setMardi1($mardi1)
    {
        $this->mardi1 = $mardi1;

        return $this;
    }

    /**
     * Get mardi1
     *
     * @return boolean
     */
    public function getMardi1()
    {
        return $this->mardi1;
    }

    /**
     * Set mardi2
     *
     * @param boolean $mardi2
     *
     * @return Disponibility
     */
    public function setMardi2($mardi2)
    {
        $this->mardi2 = $mardi2;

        return $this;
    }

    /**
     * Get mardi2
     *
     * @return boolean
     */
    public function getMardi2()
    {
        return $this->mardi2;
    }

    /**
     * Set mardi3
     *
     * @param boolean $mardi3
     *
     * @return Disponibility
     */
    public function setMardi3($mardi3)
    {
        $this->mardi3 = $mardi3;

        return $this;
    }

    /**
     * Get mardi3
     *
     * @return boolean
     */
    public function getMardi3()
    {
        return $this->mardi3;
    }

    /**
     * Set mardi4
     *
     * @param boolean $mardi4
     *
     * @return Disponibility
     */
    public function setMardi4($mardi4)
    {
        $this->mardi4 = $mardi4;

        return $this;
    }

    /**
     * Get mardi4
     *
     * @return boolean
     */
    public function getMardi4()
    {
        return $this->mardi4;
    }

    /**
     * Set mercredi1
     *
     * @param boolean $mercredi1
     *
     * @return Disponibility
     */
    public function setMercredi1($mercredi1)
    {
        $this->mercredi1 = $mercredi1;

        return $this;
    }

    /**
     * Get mercredi1
     *
     * @return boolean
     */
    public function getMercredi1()
    {
        return $this->mercredi1;
    }

    /**
     * Set mercredi2
     *
     * @param boolean $mercredi2
     *
     * @return Disponibility
     */
    public function setMercredi2($mercredi2)
    {
        $this->mercredi2 = $mercredi2;

        return $this;
    }

    /**
     * Get mercredi2
     *
     * @return boolean
     */
    public function getMercredi2()
    {
        return $this->mercredi2;
    }

    /**
     * Set mercredi3
     *
     * @param boolean $mercredi3
     *
     * @return Disponibility
     */
    public function setMercredi3($mercredi3)
    {
        $this->mercredi3 = $mercredi3;

        return $this;
    }

    /**
     * Get mercredi3
     *
     * @return boolean
     */
    public function getMercredi3()
    {
        return $this->mercredi3;
    }

    /**
     * Set mercredi4
     *
     * @param boolean $mercredi4
     *
     * @return Disponibility
     */
    public function setMercredi4($mercredi4)
    {
        $this->mercredi4 = $mercredi4;

        return $this;
    }

    /**
     * Get mercredi4
     *
     * @return boolean
     */
    public function getMercredi4()
    {
        return $this->mercredi4;
    }

    /**
     * Set jeudi1
     *
     * @param boolean $jeudi1
     *
     * @return Disponibility
     */
    public function setJeudi1($jeudi1)
    {
        $this->jeudi1 = $jeudi1;

        return $this;
    }

    /**
     * Get jeudi1
     *
     * @return boolean
     */
    public function getJeudi1()
    {
        return $this->jeudi1;
    }

    /**
     * Set jeudi2
     *
     * @param boolean $jeudi2
     *
     * @return Disponibility
     */
    public function setJeudi2($jeudi2)
    {
        $this->jeudi2 = $jeudi2;

        return $this;
    }

    /**
     * Get jeudi2
     *
     * @return boolean
     */
    public function getJeudi2()
    {
        return $this->jeudi2;
    }

    /**
     * Set jeudi3
     *
     * @param boolean $jeudi3
     *
     * @return Disponibility
     */
    public function setJeudi3($jeudi3)
    {
        $this->jeudi3 = $jeudi3;

        return $this;
    }

    /**
     * Get jeudi3
     *
     * @return boolean
     */
    public function getJeudi3()
    {
        return $this->jeudi3;
    }

    /**
     * Set jeudi4
     *
     * @param boolean $jeudi4
     *
     * @return Disponibility
     */
    public function setJeudi4($jeudi4)
    {
        $this->jeudi4 = $jeudi4;

        return $this;
    }

    /**
     * Get jeudi4
     *
     * @return boolean
     */
    public function getJeudi4()
    {
        return $this->jeudi4;
    }

    /**
     * Set vendredi1
     *
     * @param boolean $vendredi1
     *
     * @return Disponibility
     */
    public function setVendredi1($vendredi1)
    {
        $this->vendredi1 = $vendredi1;

        return $this;
    }

    /**
     * Get vendredi1
     *
     * @return boolean
     */
    public function getVendredi1()
    {
        return $this->vendredi1;
    }

    /**
     * Set vendredi2
     *
     * @param boolean $vendredi2
     *
     * @return Disponibility
     */
    public function setVendredi2($vendredi2)
    {
        $this->vendredi2 = $vendredi2;

        return $this;
    }

    /**
     * Get vendredi2
     *
     * @return boolean
     */
    public function getVendredi2()
    {
        return $this->vendredi2;
    }

    /**
     * Set vendredi3
     *
     * @param boolean $vendredi3
     *
     * @return Disponibility
     */
    public function setVendredi3($vendredi3)
    {
        $this->vendredi3 = $vendredi3;

        return $this;
    }

    /**
     * Get vendredi3
     *
     * @return boolean
     */
    public function getVendredi3()
    {
        return $this->vendredi3;
    }

    /**
     * Set vendredi4
     *
     * @param boolean $vendredi4
     *
     * @return Disponibility
     */
    public function setVendredi4($vendredi4)
    {
        $this->vendredi4 = $vendredi4;

        return $this;
    }

    /**
     * Get vendredi4
     *
     * @return boolean
     */
    public function getVendredi4()
    {
        return $this->vendredi4;
    }

    /**
     * Set samedi1
     *
     * @param boolean $samedi1
     *
     * @return Disponibility
     */
    public function setSamedi1($samedi1)
    {
        $this->samedi1 = $samedi1;

        return $this;
    }

    /**
     * Get samedi1
     *
     * @return boolean
     */
    public function getSamedi1()
    {
        return $this->samedi1;
    }

    /**
     * Set samedi2
     *
     * @param boolean $samedi2
     *
     * @return Disponibility
     */
    public function setSamedi2($samedi2)
    {
        $this->samedi2 = $samedi2;

        return $this;
    }

    /**
     * Get samedi2
     *
     * @return boolean
     */
    public function getSamedi2()
    {
        return $this->samedi2;
    }

    /**
     * Set samedi3
     *
     * @param boolean $samedi3
     *
     * @return Disponibility
     */
    public function setSamedi3($samedi3)
    {
        $this->samedi3 = $samedi3;

        return $this;
    }

    /**
     * Get samedi3
     *
     * @return boolean
     */
    public function getSamedi3()
    {
        return $this->samedi3;
    }

    /**
     * Set samedi4
     *
     * @param boolean $samedi4
     *
     * @return Disponibility
     */
    public function setSamedi4($samedi4)
    {
        $this->samedi4 = $samedi4;

        return $this;
    }

    /**
     * Get samedi4
     *
     * @return boolean
     */
    public function getSamedi4()
    {
        return $this->samedi4;
    }

    /**
     * Set dimanche1
     *
     * @param boolean $dimanche1
     *
     * @return Disponibility
     */
    public function setDimanche1($dimanche1)
    {
        $this->dimanche1 = $dimanche1;

        return $this;
    }

    /**
     * Get dimanche1
     *
     * @return boolean
     */
    public function getDimanche1()
    {
        return $this->dimanche1;
    }

    /**
     * Set dimanche2
     *
     * @param boolean $dimanche2
     *
     * @return Disponibility
     */
    public function setDimanche2($dimanche2)
    {
        $this->dimanche2 = $dimanche2;

        return $this;
    }

    /**
     * Get dimanche2
     *
     * @return boolean
     */
    public function getDimanche2()
    {
        return $this->dimanche2;
    }

    /**
     * Set dimanche3
     *
     * @param boolean $dimanche3
     *
     * @return Disponibility
     */
    public function setDimanche3($dimanche3)
    {
        $this->dimanche3 = $dimanche3;

        return $this;
    }

    /**
     * Get dimanche3
     *
     * @return boolean
     */
    public function getDimanche3()
    {
        return $this->dimanche3;
    }

    /**
     * Set dimanche4
     *
     * @param boolean $dimanche4
     *
     * @return Disponibility
     */
    public function setDimanche4($dimanche4)
    {
        $this->dimanche4 = $dimanche4;

        return $this;
    }

    /**
     * Get dimanche4
     *
     * @return boolean
     */
    public function getDimanche4()
    {
        return $this->dimanche4;
    }


    public function getValue($day,$num)
    {
        $attribute=$day.$num;
        return $this->$attribute;
    }
}

