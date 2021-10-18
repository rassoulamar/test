<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 *
 */

class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("students:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("students:read")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("students:read")
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(max=10)
     * @Groups("students:read")
     */
    private $numEtud;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="student")
     */
    private $departement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNumEtud(): ?int
    {
        return $this->numEtud;
    }

    public function setNumEtud(int $numEtud): self
    {
        $this->numEtud = $numEtud;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
