<?php

namespace App\DataPersister;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class PostPersister implements DataPersisterInterface
{
    //ici nous avons besion 'd'EntityManager pour persister les données
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($data): bool
    {
        return $data instanceof Post;   
    }

    public function persist($data)
    {
       //Mettre une date de création sur l'article
       $data->setCreatedAt(new \DateTime());
       
       //Demander à Doctrine de persister
       $this->em->persist($data);
       $this->em->flush();
    }

    public function remove($data)
    {
        //Demander à doctrine de supprimer l'article
        $this->em->remove($data);
        $this->em->flush();
 
    }
}