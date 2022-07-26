<?php

namespace App\Entity;

use App\Repository\EstablishmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EstablishmentRepository::class)
 */
class Establishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\Email(
     *     message = "Ce mail '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\Url(
     * relativeProtocol = true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $openingHour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $openingDay;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min=20,
     *      minMessage = "Votre description doit contenir {{ limit }} caractères au minimun")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(
     * relativeProtocol = true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="establishments")
     */
    private $tags;

   

    /**
     * @ORM\OneToMany(targetEntity=Package::class, mappedBy="establishment", orphanRemoval=true)
     */
    private $packages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="establishments")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $user;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Style::class, inversedBy="establishments")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $style;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitudes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitudes;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->packages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

   

    public function getOpeningHour(): ?\DateTimeInterface
    {
        return $this->openingHour;
    }

    public function setOpeningHour(?\DateTimeInterface $openingHour): self
    {
        $this->openingHour = $openingHour;

        return $this;
    }

    public function getOpeningDay(): ?\DateTimeInterface
    {
        return $this->openingDay;
    }

    public function setOpeningDay(?\DateTimeInterface $openingDay): self
    {
        $this->openingDay = $openingDay;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addEstablishment($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeEstablishment($this);
        }

        return $this;
    }

  

    /**
     * @return Collection<int, Package>
     */
    public function getPackages(): Collection
    {
        return $this->packages;
    }

    public function addPackage(Package $package): self
    {
        if (!$this->packages->contains($package)) {
            $this->packages[] = $package;
            $package->setEstablishment($this);
        }

        return $this;
    }

    public function removePackage(Package $package): self
    {
        if ($this->packages->removeElement($package)) {
            // set the owning side to null (unless already changed)
            if ($package->getEstablishment() === $this) {
                $package->setEstablishment(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getLongitudes(): ?float
    {
        return $this->longitudes;
    }

    public function setLongitudes(?float $longitudes): self
    {
        $this->longitudes = $longitudes;

        return $this;
    }

    public function getLatitudes(): ?float
    {
        return $this->latitudes;
    }

    public function setLatitudes(?float $latitudes): self
    {
        $this->latitudes = $latitudes;

        return $this;
    }
}
