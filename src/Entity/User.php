<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    public function __construct()
    {
        parent::__construct();
        $this->bankCarts = new ArrayCollection();
        $this->reservaties = new ArrayCollection();
        // your own logic
    }
    public function __toString()
    {
        return parent::__toString (); // TODO: Change the autogenerated stub
    }
    /**
     * Date/Time of the last activity
     *
     * @var \Datetime
     *
     * @ORM\Column(name="last_activity_at", type="datetimetz", nullable=true)
     */
    protected $lastActivityAt;
    /**
     * @var string
     *
     * @ORM\Column(name="telnr", type="string", length=255, nullable=true)
     */
    private $telnr;
    /**
     * @var string
     *
     * @ORM\Column(name="mobilenr", type="string", length=255, nullable=true)
     */
    private $mobilenr;
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="insertionname", type="string", length=255, nullable=true)
     */
    private $insertionname;
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;
    /**
     * @var string
     *
     * @ORM\Column(name="adres", type="string", length=255, nullable=true)
     */
    private $adres;
    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=10, nullable=true)
     */
    private $zip;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLastActivityAt(): ?\DateTimeInterface
    {
        return $this->lastActivityAt;
    }
    public function setLastActivityAt(?\DateTimeInterface $lastActivityAt): self
    {
        $this->lastActivityAt = $lastActivityAt;
        return $this;
    }
    public function getTelnr(): ?string
    {
        return $this->telnr;
    }
    public function setTelnr(?string $telnr): self
    {
        $this->telnr = $telnr;
        return $this;
    }
    public function getMobilenr(): ?string
    {
        return $this->mobilenr;
    }
    public function setMobilenr(?string $mobilenr): self
    {
        $this->mobilenr = $mobilenr;
        return $this;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }
    public function getInsertionname(): ?string
    {
        return $this->insertionname;
    }
    public function setInsertionname(?string $insertionname): self
    {
        $this->insertionname = $insertionname;
        return $this;
    }
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }
    public function getAdres(): ?string
    {
        return $this->adres;
    }
    public function setAdres(?string $adres): self
    {
        $this->adres = $adres;
        return $this;
    }
    public function getZip(): ?string
    {
        return $this->zip;
    }
    public function setZip(?string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getCountry(): ?string
    {
        return $this->country;
    }
    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

}