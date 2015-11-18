<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BabySitter
 *
 * @ORM\Table(name="b_babysitter")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class BabySitter
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
     * @Gedmo\Slug(fields={"firstName", "lastName"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255,nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255,nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255,nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="near", type="string", length=255)
     */
    private $near;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255,nullable=true)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="howManyKM", type="integer")
     */
    private $howManyKM;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="shortDescription", type="text")
     */
    private $shortDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var array
     *
     * @ORM\Column(name="Languages", type="array")
     */
    private $languages;

    /**
     * @var integer
     *
     * @ORM\Column(name="yearsExperiance", type="integer")
     */
    private $yearsExperiance;

    /**
     * @var integer
     *
     * @ORM\Column(name="kidsAbleCarry", type="integer")
     */
    private $kidsAbleCarry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pets", type="boolean",nullable=true)
     */
    private $pets;

    /**
     * @var boolean
     *
     * @ORM\Column(name="smoker", type="boolean",nullable=true)
     */
    private $smoker;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alcoholic", type="boolean",nullable=true)
     */
    private $alcoholic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="provideSickCare", type="boolean",nullable=true)
     */
    private $provideSickCare;

    /**
     * @var boolean
     *
     * @ORM\Column(name="specialNeeds", type="boolean",nullable=true)
     */
    private $specialNeeds;

    /**
     * @var boolean
     *
     * @ORM\Column(name="homeWorkHelp", type="boolean",nullable=true)
     */
    private $homeWorkHelp;

    /**
     * @var string
     *
     * @ORM\Column(name="education", type="string", length=255)
     */
    private $education;

    /**
     * @var string
     *
     * @ORM\Column(name="religion", type="string", length=255)
     */
    private $religion;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="facebook", type="string", length=255,nullable=true)
     */
    private $facebook;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="linkedIn", type="string", length=255,nullable=true)
     */
    private $linkedIn;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="googlePlus", type="string", length=255,nullable=true)
     */
    private $googlePlus;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="twitter", type="string", length=255,nullable=true)
     */
    private $twitter;

    /**
     * @var \DateTime
     *
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $path;

    /**
     * @Assert\Image()
     */
    public $file;

    public function getUploadRootDir()
    {
        return __dir__ . '/../../../../web/uploads/BabySitter';
    }

    public function getAbsolutePath()
    {
        return NULL === $this->path ? NULL : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getAssetPath()
    {
        return 'uploads/BabySitter/' . $this->path;
    }

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->path;
        $this->updateAt = new \DateTime();
        if(NULL !== $this->file)
            $this->path = sha1(uniqid(mt_rand(),TRUE)) . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if(NULL !== $this->file){
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
            if($this->oldFile != NULL && file_exists($this->tempFile))
                unlink($this->tempFile);
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->tempFile))
            unlink($this->tempFile);
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set address
     *
     * @param string $address
     *
     * @return BabySitter
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return BabySitter
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return BabySitter
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return BabySitter
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return BabySitter
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    

    /**
     * Set yearsExperiance
     *
     * @param integer $yearsExperiance
     *
     * @return BabySitter
     */
    public function setYearsExperiance($yearsExperiance)
    {
        $this->yearsExperiance = $yearsExperiance;

        return $this;
    }

    /**
     * Get yearsExperiance
     *
     * @return integer
     */
    public function getYearsExperiance()
    {
        return $this->yearsExperiance;
    }

    /**
     * Set kidsAbleCarry
     *
     * @param integer $kidsAbleCarry
     *
     * @return BabySitter
     */
    public function setKidsAbleCarry($kidsAbleCarry)
    {
        $this->kidsAbleCarry = $kidsAbleCarry;

        return $this;
    }

    /**
     * Get kidsAbleCarry
     *
     * @return integer
     */
    public function getKidsAbleCarry()
    {
        return $this->kidsAbleCarry;
    }

    /**
     * Set pets
     *
     * @param boolean $pets
     *
     * @return BabySitter
     */
    public function setPets($pets)
    {
        $this->pets = $pets;

        return $this;
    }

    /**
     * Get pets
     *
     * @return boolean
     */
    public function getPets()
    {
        return $this->pets;
    }

    /**
     * Set smoker
     *
     * @param boolean $smoker
     *
     * @return BabySitter
     */
    public function setSmoker($smoker)
    {
        $this->smoker = $smoker;

        return $this;
    }

    /**
     * Get smoker
     *
     * @return boolean
     */
    public function getSmoker()
    {
        return $this->smoker;
    }

    /**
     * Set alcoholic
     *
     * @param boolean $alcoholic
     *
     * @return BabySitter
     */
    public function setAlcoholic($alcoholic)
    {
        $this->alcoholic = $alcoholic;

        return $this;
    }

    /**
     * Get alcoholic
     *
     * @return boolean
     */
    public function getAlcoholic()
    {
        return $this->alcoholic;
    }

    /**
     * Set provideSickCare
     *
     * @param boolean $provideSickCare
     *
     * @return BabySitter
     */
    public function setProvideSickCare($provideSickCare)
    {
        $this->provideSickCare = $provideSickCare;

        return $this;
    }

    /**
     * Get provideSickCare
     *
     * @return boolean
     */
    public function getProvideSickCare()
    {
        return $this->provideSickCare;
    }

    /**
     * Set specialNeeds
     *
     * @param boolean $specialNeeds
     *
     * @return BabySitter
     */
    public function setSpecialNeeds($specialNeeds)
    {
        $this->specialNeeds = $specialNeeds;

        return $this;
    }

    /**
     * Get specialNeeds
     *
     * @return boolean
     */
    public function getSpecialNeeds()
    {
        return $this->specialNeeds;
    }

    /**
     * Set homeWorkHelp
     *
     * @param boolean $homeWorkHelp
     *
     * @return BabySitter
     */
    public function setHomeWorkHelp($homeWorkHelp)
    {
        $this->homeWorkHelp = $homeWorkHelp;

        return $this;
    }

    /**
     * Get homeWorkHelp
     *
     * @return boolean
     */
    public function getHomeWorkHelp()
    {
        return $this->homeWorkHelp;
    }

    /**
     * Set education
     *
     * @param string $education
     *
     * @return BabySitter
     */
    public function setEducation($education)
    {
        $this->education = $education;

        return $this;
    }

    /**
     * Get education
     *
     * @return string
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="babysitter")
     */
    protected $user;

    /**
     * Set user
     *
     * @param \Back\UserBundle\Entity\User $user
     *
     * @return BabySitter
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
     * Set languages
     *
     * @param array $languages
     *
     * @return BabySitter
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set religion
     *
     * @param string $religion
     *
     * @return BabySitter
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * Get religion
     *
     * @return string
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return BabySitter
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return BabySitter
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set near
     *
     * @param string $near
     *
     * @return BabySitter
     */
    public function setNear($near)
    {
        $this->near = $near;

        return $this;
    }

    /**
     * Get near
     *
     * @return string
     */
    public function getNear()
    {
        return $this->near;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return BabySitter
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set howManyKM
     *
     * @param integer $howManyKM
     *
     * @return BabySitter
     */
    public function setHowManyKM($howManyKM)
    {
        $this->howManyKM = $howManyKM;

        return $this;
    }

    /**
     * Get howManyKM
     *
     * @return integer
     */
    public function getHowManyKM()
    {
        return $this->howManyKM;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return BabySitter
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set linkedIn
     *
     * @param string $linkedIn
     *
     * @return BabySitter
     */
    public function setLinkedIn($linkedIn)
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    /**
     * Get linkedIn
     *
     * @return string
     */
    public function getLinkedIn()
    {
        return $this->linkedIn;
    }

    /**
     * Set googlePlus
     *
     * @param string $googlePlus
     *
     * @return BabySitter
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;

        return $this;
    }

    /**
     * Get googlePlus
     *
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return BabySitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return BabySitter
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return BabySitter
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return BabySitter
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return BabySitter
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
