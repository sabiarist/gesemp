<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Ausi\SlugGenerator\SlugGenerator;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Service;


/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
{
    const SERVICE = [
        0 => 'Commerce',
        1 => 'Divers',
        2 => 'Informatique'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction;

    /**
     * @ORM\Column(type="datetime")
     */
    private $embauche_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $serviceemp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function getSlug():string {
        return (new SlugGenerator)->generate($this->nom);
        return (new SlugGenerator)->generate($this->prenom);
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getEmbaucheAt(): ?\DateTimeInterface
    {
        return $this->embauche_at;
    }

    public function setEmbaucheAt(\DateTimeInterface $embauche_at): self
    {
        $this->embauche_at = $embauche_at;

        return $this;
    }
    public function __construct()
    {
        $this->embauche_at = new \DateTime();
    }

    public function getServiceemp(): ?int
    {
        return $this->serviceemp;
    }

    public function setServiceemp(int $serviceemp): self
    {
        $this->serviceemp = $serviceemp;

        return $this;
    }
    public function getServiceType():string {
        return self::SERVICE[$this->serviceemp];
    }
}
