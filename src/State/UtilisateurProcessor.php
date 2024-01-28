<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Utilisateur;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurProcessor implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor,
        private UserPasswordHasherInterface $passwordHasher
    )
    {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        //Modification des données de $data
        /**
         * @var $data Utilisateur
         */
        $this->passwordHasher->hashPassword($data,$data->getPlainPassword());
        $data->eraseCredentials();
        //Sauvegarde en base
        $this->persistProcessor->process($this->passwordHasher, $operation, $uriVariables, $context);
    }
}