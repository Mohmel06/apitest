<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;

class MoiController
{
    /**
     * @var Security
     */  
    
    private Security $security;


    public function __construct(Security $security){

        $this->security = $security;
    }

    public function __invoke()
    {
        $user = $this->security->getUser();
        return $user;
    }
}