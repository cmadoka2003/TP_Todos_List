<?php

namespace App\Entity;

use App\Repository\TodosRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TodosRepository::class)]
class TodosList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    
    #[ORM\Column(type: "string")]
    private ?string $date = null;

    #[ORM\OneToMany(
        targetEntity:"App\Entity\Taches", 
        mappedBy:"todosList", 
        cascade:['persist', 'remove']
    )]
    private $taches;

    function __construct()
    {  
        $this->taches = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }    
    
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getTaches()
    {
        return $this->taches;
    }

    public function addTaches(Taches $taches)
    {
        $taches->setTodosList($this);
        $this->taches->add($taches);
    }
}