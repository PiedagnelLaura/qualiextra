<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * 
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=42)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Establishment::class, mappedBy="user", orphanRemoval=true)
     */
    private $establishments;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="users", orphanRemoval=true)
     */
    private $books;

    public function __construct()
    {
        $this->establishments = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Establishment>
     */
    public function getEstablishments(): Collection
    {
        return $this->establishments;
    }

    public function addEstablishment(Establishment $establishment): self
    {
        if (!$this->establishments->contains($establishment)) {
            $this->establishments[] = $establishment;
            $establishment->setUser($this);
        }

        return $this;
    }

    public function removeEstablishment(Establishment $establishment): self
    {
        if ($this->establishments->removeElement($establishment)) {
            // set the owning side to null (unless already changed)
            if ($establishment->getUser() === $this) {
                $establishment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setUsers($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getUsers() === $this) {
                $book->setUsers(null);
            }
        }

        return $this;
    }
}


   //Users
   $usersList= [];
   $user = new User();                     
   $user->setFirstname($faker->firstname());
   $user->setLastname($faker->lastname());
   $user->setEmail("user@user.com");
   $user->setPassword("user");
   $user->setRole("ROLE_USER");

   $usersList[]= $user;
   
   $manager->persist($user);

   // ------------userAdmin-----------

   $userAdmin = new User();
   $userAdmin->setFirstname($faker->firstname());
   $userAdmin->setLastname($faker->lastname());
   $userAdmin->setEmail("admin@admin.com");
   $userAdmin->setPassword("admin");
   $userAdmin->setRole("ROLE_ADMIN");

   $usersList[]= $userAdmin;
   
   $manager->persist($userAdmin);
   
   // ------------userManager-----------

   $userPro= new User();
   $userPro->setFirstname($faker->firstname());
   $userPro->setLastname($faker->lastname());
   $userPro->setEmail("pro@pro.com");
   $userPro->setPassword("pro");
   $userPro->setRole("ROLE_PRO");

   $usersList[]= $userPro;
   
   $manager->persist($userPro);
   

   
