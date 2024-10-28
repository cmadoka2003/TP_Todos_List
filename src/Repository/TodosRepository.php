<?php

namespace App\Repository;

use App\Entity\TodosList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, TodosList::class);
    }

    public function sauvegarder(TodosList $nouveauTodosList, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($nouveauTodosList);
    
        if($isSave){
            $this->getEntityManager()->flush();
        }
        return $nouveauTodosList;
    }

    public function supprimer(TodosList $todo)
    {
        $this->getEntityManager()->remove($todo);
        $this->getEntityManager()->flush();
    }
}