<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 *
 * @ORM\Table(name="b_booking")
 * @ORM\Entity(repositoryClass="Back\UserBundle\Entity\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateBooking", type="datetime")
     */
    private $dateBooking;

    /**
     * @var integer
     * 1:not payed
     * 2:payed
     * 3:validated
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status=1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour", type="time")
     */
    private $hour;

    /**
     * @var integer
     * @Assert\Range(min = 1,max = 100)
     * @ORM\Column(name="numberHour", type="integer")
     */
    private $numberHour;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTrasaction", type="datetime",nullable=true)
     */
    private $dateTrasaction;

    /**
     * @var string
     *
     * @ORM\Column(name="idTransaction", type="string", length=255,nullable=true)
     */
    private $idTransaction;

    /**
     * @var array
     *
     * @ORM\Column(name="paypalData", type="array",nullable=true)
     */
    private $paypalData;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\BabySitter")
     */
    protected $babysitter;

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param string $total
     * @return Booking
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
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
     * Set dateBooking
     *
     * @param \DateTime $dateBooking
     *
     * @return Booking
     */
    public function setDateBooking($dateBooking)
    {
        $this->dateBooking = $dateBooking;

        return $this;
    }

    /**
     * Get dateBooking
     *
     * @return \DateTime
     */
    public function getDateBooking()
    {
        return $this->dateBooking;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Booking
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set hour
     *
     * @param \DateTime $hour
     *
     * @return Booking
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return \DateTime
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set numberHour
     *
     * @param integer $numberHour
     *
     * @return Booking
     */
    public function setNumberHour($numberHour)
    {
        $this->numberHour = $numberHour;

        return $this;
    }

    /**
     * Get numberHour
     *
     * @return integer
     */
    public function getNumberHour()
    {
        return $this->numberHour;
    }

    /**
     * Set dateTrasaction
     *
     * @param \DateTime $dateTrasaction
     *
     * @return Booking
     */
    public function setDateTrasaction($dateTrasaction)
    {
        $this->dateTrasaction = $dateTrasaction;

        return $this;
    }

    /**
     * Get dateTrasaction
     *
     * @return \DateTime
     */
    public function getDateTrasaction()
    {
        return $this->dateTrasaction;
    }

    /**
     * Set idTransaction
     *
     * @param string $idTransaction
     *
     * @return Booking
     */
    public function setIdTransaction($idTransaction)
    {
        $this->idTransaction = $idTransaction;

        return $this;
    }

    /**
     * Get idTransaction
     *
     * @return string
     */
    public function getIdTransaction()
    {
        return $this->idTransaction;
    }

    /**
     * Set paypalData
     *
     * @param array $paypalData
     *
     * @return Booking
     */
    public function setPaypalData($paypalData)
    {
        $this->paypalData = $paypalData;

        return $this;
    }

    /**
     * Get paypalData
     *
     * @return array
     */
    public function getPaypalData()
    {
        return $this->paypalData;
    }

    /**
     * Set user
     *
     * @param \Back\UserBundle\Entity\User $user
     *
     * @return Booking
     */
    public function setUser(\Back\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Back\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set babysitter
     *
     * @param \Back\UserBundle\Entity\BabySitter $babysitter
     *
     * @return Booking
     */
    public function setBabysitter(\Back\UserBundle\Entity\BabySitter $babysitter = null)
    {
        $this->babysitter = $babysitter;

        return $this;
    }

    /**
     * Get babysitter
     *
     * @return \Back\UserBundle\Entity\BabySitter
     */
    public function getBabysitter()
    {
        return $this->babysitter;
    }


    public function showStatus()
    {
        switch($this->status)
        {
            case 1 : return "Not paid";
            case 2 : return "Paid";
            case 3 : return "Validated";
        }
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Booking
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     * @return Booking
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Booking
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Booking
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
