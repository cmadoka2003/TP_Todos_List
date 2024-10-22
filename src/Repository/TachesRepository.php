<?php

namespace App\Repository;

use App\Entity\Taches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TachesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Taches::class);
    }

    public function sauvegarder(Taches $nouvelleTache, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($nouvelleTache);
    
        if($isSave){
            $this->getEntityManager()->flush();
        }
        return $nouvelleTache;
    }
}