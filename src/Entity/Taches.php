<?php

namespace App\Entity;

use App\Repository\TachesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TachesRepository::class)]
class Taches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: "boolean")]
    private ?bool $isFinished = false;

    #[ORM\ManyToOne(targetEntity: TodosList::class, inversedBy: 'taches')]
    private $todosList;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIsFinished()
    {
        return $this->isFinished;
    }

    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getTodosList()
    {
        return $this->todosList;
    }

    public function setTodosList($todosList)
    {
        $this->todosList = $todosList;

        return $this;
    }
}