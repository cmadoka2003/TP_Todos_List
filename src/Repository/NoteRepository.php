<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Note::class);
    }

    public function sauvegarder(Note $nouvelleNote, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($nouvelleNote);
    
        if($isSave){
            $this->getEntityManager()->flush();
        }
        return $nouvelleNote;
    }

    public function supprimer(Note $note)
    {
        $this->getEntityManager()->remove($note);
        $this->getEntityManager()->flush();
    }
}